<?php

namespace App\Http\Controllers\User\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingAnnouncementRequests\storeAdditionalSettings;
use App\Http\Requests\TrainingAnnouncementRequests\storeRequest;
use App\Http\Requests\TrainingAnnouncementRequests\storeSchedulingTrainingSessions;
use App\Http\Requests\TrainingAnnouncementRequests\StoreTrainingAssistantManagementRequest;
use App\Http\Requests\TrainingAnnouncementRequests\StoreTrainingGoalsRequest;
use App\Models\additional_setting;
use App\Models\Advertisement;
use App\Models\Country;
use App\Models\Language;
use App\Models\programPresentationMethod;
use App\Models\programType;
use App\Models\schedulingTrainingSessions;
use App\Models\trainingAssistantManagement;
use App\Models\TrainingClassification;
use App\Models\TrainingDetail;
use App\Models\trainingLevel;
use App\Models\TrainingProgram;
use App\Models\User;
use App\Services\TrainingAnnouncementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingAnnouncementController extends Controller
{
    protected $TrainingAnnouncementService;

    public function __construct(TrainingAnnouncementService $TrainingAnnouncementService)
    {
        $this->TrainingAnnouncementService = $TrainingAnnouncementService;
    }
    public function BasicTrainingInformationView()
    {
        return view('trainingAnnouncement.BasicTrainingInformation', [
            'types' => programType::all(),
            'levels' => trainingLevel::all(),
            'languages' => Language::all(),
            'classifications' => TrainingClassification::all(),
            'presentationMethods' => programPresentationMethod::all(),
        ]);
    }
    public function BasicTrainingInformation(storeRequest $request)
        {
            $validated = $request->validated();
            session()->put('training_program_step_1', $validated);
            return redirect()->route('trainingGoals.create');//step two
        }
    public function trainingGoalsView()
        {
            return view('trainingAnnouncement.trainingGoals');
        }

    public function trainingGoals(StoreTrainingGoalsRequest $request)
    {
        $validated = $request->validated();
        $encoded = [
            'learning_outcomes'    => json_encode($validated['learning_outcomes']),
            'requirements'         => json_encode($validated['requirements'] ?? []),
            'target_audience'      => json_encode($validated['target_audience'] ?? []),
            'benefits'             => json_encode($validated['benefits'] ?? []),
        ];
        session()->put('training_goals_content', $encoded);

        return redirect()->route('training_assistant_management.create');//step three
    }
    public function createTrainingAndAssistantManagement()
    {
        $users = User::all();
        return view('trainingAnnouncement.create-training-and-assistant-management', compact('users'));
    }
    
    public function storeTrainingAndAssistantManagement(StoreTrainingAssistantManagementRequest $request)
    {
        $validated = $request->validated();
    
        session()->put('training_assistant_management', $validated);
    
        return redirect()->route('scheduling_training_sessions.create');//step four
    }
    public function createSchedulingTrainingSessions()
    {
        $programs = TrainingProgram::all();
        return view('trainingAnnouncement.scheduling-training-sessions', compact('programs'));
    }

    public function storeSchedulingTrainingSessions(storeSchedulingTrainingSessions $request)
    {
        $validated = $request->validated();
        session()->put('schedulingTrainingSessions', $validated);
        return redirect()->route('additional_settings.create');//step five
    }
    public function createAdditionalSettings()
    {
        $programs = TrainingProgram::all();
        $countries = Country::all();

        return view('trainingAnnouncement.additional_settings', compact('programs', 'countries'));
    }

    public function storeAdditionalSettings(storeAdditionalSettings $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        if ($request->hasFile('training_files')) {
            $validated['training_files'] = collect($request->file('training_files'))
                ->map(fn($file) => $file->store('training_files', 'public'))
                ->toArray();
        }

        $validated['is_free'] = $request->has('is_free') ? 1 : 0;
        
        session()->put('storeAdditionalSettings', $validated);
        return redirect()->route('training.review');//last step review
    }
    public function review()
    {
        $assistants = session('training_assistant_management');

        $trainerIds = $assistants['trainer_ids'] ?? [];
        $assistantIds = $assistants['assistant_ids'] ?? [];

        $trainerNames = User::whereIn('id', $trainerIds)->pluck('name', 'id')->toArray();
        $assistantNames = User::whereIn('id', $assistantIds)->pluck('name', 'id')->toArray();

        return view('trainingAnnouncement.final-review', [
            'step1' => session('training_program_step_1'),
            'goals' => session('training_goals_content'),
            'assistants' => $assistants,
            'trainerNames' => $trainerNames,
            'assistantNames' => $assistantNames,
            'scheduling' => session('schedulingTrainingSessions'),
            'settings' => session('storeAdditionalSettings'),
        ]);
    }
    public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $step1 = session('training_program_step_1');

        $program =TrainingProgram::create([
            'title' => $step1['title'],
            'description' => $step1['description'],
            'program_type_id' => $step1['program_type_id'],
            'language_type_id' => $step1['language_type_id'],
            'training_classification_id' => $step1['training_classification_id'],
            'training_level_id' => $step1['training_level_id'],
            'program_presentation_method_id' => $step1['program_presentation_method_id'],
            
        ]);

        $goal = session('training_goals_content');

        TrainingDetail::create([
            'training_program_id' => $program->id,
            'learning_outcomes' => json_encode($goal['learning_outcomes']),
            'requirements' => json_encode($goal['requirements']),
            'target_audience' => json_encode($goal['target_audience']),
            'benefits' => json_encode($goal['benefits']),
        ]);
        

        $assistants = session('training_assistant_management');

        foreach ($assistants['trainer_ids'] ?? [] as $trainerId) {
            foreach ($assistants['assistant_ids'] ?? [] as $assistantId) {
                trainingAssistantManagement::create([
                    'training_program_id' => $program->id,
                    'trainer_id' => $trainerId,
                    'assistant_id' => $assistantId,
                ]);
            }
        }

        $schedules = session('schedulingTrainingSessions.schedules', []);
        foreach ($schedules as $entry) {
            schedulingTrainingSessions::create([
                'training_program_id' => $program->id,
                'session_date' => $entry['session_date'],
                'duration_minutes' => $entry['duration_minutes'],
            ]);
        }
        $settings = session('storeAdditionalSettings');

        additional_setting::create([
            'training_program_id' => $program->id,
            'is_free' => $settings['is_free'] ?? false,
            'cost' => $settings['cost'] ?? null,
            'currency' => $settings['currency'] ?? null,
            'payment_method' => $settings['payment_method'] ?? null,
            'country_id' => $settings['country_id'] ?? null,
            'city' => $settings['city'] ?? null,
            'residential_address' => $settings['residential_address'] ?? null,
            'application_deadline' => $settings['application_deadline'],
            'max_trainees' => $settings['max_trainees'],
            'application_submission_method' => $settings['application_submission_method'],
            'registration_link' => $settings['registration_link'] ?? null,
            'profile_image' => $settings['profile_image'] ?? null,
            'training_files' => json_encode($settings['training_files'] ?? []),
        ]);

        DB::commit();

        session()->forget([
            'training_program_step_1',
            'training_goals_content',
            'training_assistant_management',
            'schedulingTrainingSessions',
            'storeAdditionalSettings',
        ]);

        return redirect()->route('homePage')->with('success', 'تم حفظ البرنامج التدريبي وجميع التفاصيل بنجاح.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage());
    }
}


    

}
