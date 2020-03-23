<?php

namespace App\Action;

use App\Util\Exception\UnauthorizedException;
use App\Util\Exception\AppException;
use Carbon\Carbon;

class UserPanelAction
{
    protected $options;
    protected $representation;
    protected $helper;
    protected $authorization;
    protected $db;
    protected $filesystem;
    protected $pagination;
    protected $view;

    public function __construct(
        $options, $representation, $helper, $authorization, $db, $filesystem, $pagination, $view
    ) {
        $this->options = $options;
        $this->representation = $representation;
        $this->helper = $helper;
        $this->authorization = $authorization;
        $this->db = $db;
        $this->filesystem = $filesystem;
        $this->pagination = $pagination;
        $this->view = $view;
    }

    //
    public function showOverview($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'user')) {
            throw new UnauthorizedException();
        }
        return $this->view->render($response, 'user-panel/overview.twig', []);
    }
    public function showChangePassword($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'user')) {
            throw new UnauthorizedException();
        }
        return $this->view->render($response, 'user-panel/account/change-pass.twig', []);
    }

    public function showProjects($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'verified')) {
            throw new UnauthorizedException();
        }
        $user = $this->helper->getUserFromSubject($subject);
        $projects = $this->db->query('App:Project', ['district','category'])
            ->where('author_id', $user->id)->get()->toArray();
        return $this->view->render($response, 'user-panel/project/projects.twig', [
            'proyectos' => $projects,
        ]);
    }
    public function showCreateProject($request, $response, $params)
    {
        $available = $this->options->getOption('proposals-available')->value;
        $appState = $this->options->getOption('current-state')->value == 'upload-proposals';
        // Is the form available and the state is upload-proposals?
        if (!$available || !$appState) {
            throw new AppException('El formulario no se encuentra disponible');
        }
        // Proposals should be accepted during the period!
        $launch = $this->options->getOption('proposals-launch')->value;
        $deadline = $this->options->getOption('proposals-deadline')->value;
        $today = Carbon::now();
        if (!$today->between($launch, $deadline)) {
            throw new AppException('El plazo de presentación y edición de proyectos ha vencido.');
        }
        // Must be verified!
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'verified')) {
            throw new UnauthorizedException();
        }
        // Retrieve options
        $currentChapter = $this->options->getOption('current-chapter')->value;
        // Retrieve categories from DB
        $categories = $this->db->query('App:Category')->get()->toArray();
        $districts = $this->db->query('App:District')->get()->toArray();
        // Retrieve project fields from DB
        $projectFields = $this->db->query('App:ProjectFields')->where('chapter',$currentChapter)->first()->toArray();
        // Retrieve blocks form DB
        $path = $request->getUri()->getPath();
        $blocks = $this->db->query('App:Pageblock')->where('path',$path)->where('hidden',false)->orderBy('order')->get()->toArray();
        $user = $this->helper->getUserFromSubject($subject);
        $user->addVisible(['email','dni']);
        return $this->view->render($response, 'user-panel/project/create-project.twig', [
            'categories' => $categories,
            'districts' => $districts,
            'projectFields' => $projectFields,
            'blocks' => $blocks,
            'user' => $user,
        ]);
    }
    public function showEditProject($request, $response, $params)
    {
        $available = $this->options->getOption('proposals-available')->value;
        $appState = $this->options->getOption('current-state')->value == 'upload-proposals';
        if (!$available || !$appState) {
            throw new AppException('El formulario no se encuentra disponible');
        }
        $launch = $this->options->getOption('proposals-launch')->value;
        $deadline = $this->options->getOption('proposals-deadline')->value;
        $today = Carbon::now();
        if (!$today->between($launch, $deadline)) {
            throw new AppException('El plazo de presentación y edición de proyectos ha vencido.');
        }
        $subject = $request->getAttribute('subject');
        $project = $this->helper->getEntityFromId(
            'App:Project', 'pro', $params, ['author']
        );
        if (!$this->authorization->checkPermission($subject, 'updateProject', $project)) {
            throw new UnauthorizedException();
        }
        $project->addVisible(['author_phone', 'author_email', 'author_dni','author','field_values','budget']);
         // Retrieve options
        // Retrieve categories from DB
        $categories = $this->db->query('App:Category')->get()->toArray();
        $districts = $this->db->query('App:District')->get()->toArray();
        // Retrieve project fields from DB
        $projectFields = $this->db->query('App:ProjectFields')->where('chapter',$project->chapter)->first()->toArray();
        // Retrieve blocks form DB
        $path = $request->getUri()->getPath();
        $blocks = $this->db->query('App:Pageblock')->where('path',$path)->where('hidden',false)->orderBy('order')->get()->toArray();
        return $this->view->render($response, 'user-panel/project/edit-project.twig', [
            'proyecto' => $project->toArray(),
            'categories' => $categories,
            'districts' => $districts,
            'projectFields' => $projectFields,
            'blocks' => $blocks,
        ]);
    }

    public function showProjectImage($request, $response, $params)
    {
        $available = $this->options->getOption('proposals-available')->value;
        $appState = $this->options->getOption('current-state')->value == 'upload-proposals';
        if (!$available || !$appState) {
            throw new AppException('El formulario no se encuentra disponible');
        }
        $launch = $this->options->getOption('proposals-launch')->value;
        $deadline = $this->options->getOption('proposals-deadline')->value;
        $today = Carbon::now();
        if (!$today->between($launch, $deadline)) {
            throw new AppException('El plazo de presentación y edición de proyectos ha vencido.');
        }
        $subject = $request->getAttribute('subject');
        $project = $this->helper->getEntityFromId(
            'App:Project', 'pro', $params
        );
         if (!$this->authorization->checkPermission($subject, 'updateProject', $project)) {
            throw new UnauthorizedException();
        }
        return $this->view->render($response, 'user-panel/project/edit-project-image.twig', [
            'proyecto' => $project->toArray(),
        ]);
    }
    
    // TODO
    public function showProjectFiles($request, $response, $params)
    {
        $available = $this->options->getOption('proposals-available')->value;
        $appState = $this->options->getOption('current-state')->value == 'upload-proposals';
        if (!$available || !$appState) {
            throw new AppException('El formulario no se encuentra disponible');
        }
        $launch = $this->options->getOption('proposals-launch')->value;
        $deadline = $this->options->getOption('proposals-deadline')->value;
        $today = Carbon::now();
        if (!$today->between($launch, $deadline)) {
            throw new AppException('El plazo de presentación y edición de proyectos ha vencido.');
        }
        $subject = $request->getAttribute('subject');
        $project = $this->helper->getEntityFromId(
            'App:Project', 'pro', $params, ['documents']
        );
         if (!$this->authorization->checkPermission($subject, 'updateProject', $project)) {
            throw new UnauthorizedException();
        }
        $project->addVisible(['documents']);
        return $this->view->render($response, 'user-panel/project/edit-project-files.twig', [
            'proyecto' => $project->toArray(),
        ]);
    }

    public function showProjectJournal($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        $project = $this->helper->getEntityFromId(
            'App:Project', 'pro', $params, ['author']
        );
         if (!$this->authorization->checkPermission($subject, 'updateProject', $project)) {
            throw new UnauthorizedException();
        }
        $userArr = array();
        foreach ($project->journal as $key => $value) {
            $user = $this->helper->getEntityFromId(
            'App:User', $value['author_id'], null, ['subject']
            );
            $userArr[$value['author_id']] = $user->subject->toDummy()->toArray();
        }
        $projectFields = $this->db->query('App:ProjectFields')->where('chapter',$project->chapter)->first()->toArray();
        $project->addVisible(['notes', 'author_phone', 'author_email', 'author_dni','author','journal']);
        return $this->view->render($response, 'user-panel/project/edit-project-journal.twig', [
            'proyecto' => $project->toArray(),
            'projectFields' => $projectFields,
            'users' => $userArr
        ]);
    }
}