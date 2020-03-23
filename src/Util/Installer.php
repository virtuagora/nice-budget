<?php

namespace App\Util;

use Carbon\Carbon;

class Installer
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $this->db->schema()->create('options', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key', 25)->unique();
            $table->text('value')->nullable();
            $table->string('type'); //integer, string, text, hidden
            $table->string('group');
            $table->boolean('autoload');
            $table->timestamps();
        });
        $this->db->schema()->create('categories', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key');
            $table->string('name');
            $table->string('fontawesome_icon');
        });
        $this->db->schema()->create('districts', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
        });
        $this->db->schema()->create('neighbourhoods', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
        $this->db->schema()->create('citizens', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('dni', 15)->unique();
            $table->string('fullname',800);
            $table->integer('year');
            $table->string('table')->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->json('data')->nullable();
            $table->string('genre')->nullable();
            $table->boolean('voted')->default(false);
            $table->index('dni');
        });
        $this->db->schema()->create('subjects', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('display_name');
            $table->integer('img_type')->unsigned();
            $table->string('img_hash');
            $table->integer('points')->default(0);
            $table->string('type');
            $table->string('trace')->nullable();
            $table->integer('citizen_id')->unsigned()->nullable();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('neighbourhood_id')->unsigned()->nullable();
            $table->foreign('neighbourhood_id')->references('id')->on('neighbourhoods')->onDelete('cascade');
        });
        $this->db->schema()->create('roles', function ($table) {
            $table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('name', 25)->unique();
            $table->timestamps();
        });
        $this->db->schema()->create('subject_role', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamp('expiration')->nullable();
            $table->integer('subject_id')->unsigned();
            $table->string('role_id', 50);
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
        $this->db->schema()->create('users', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('names');
            $table->string('surnames');
            $table->string('dni');
            $table->dateTime('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('telephone')->nullable();
            $table->text('bio')->nullable();
            $table->string('pending_email')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('token_expiration')->nullable();
            $table->timestamp('ban_expiration')->nullable();
            $table->string('trace')->nullable();
            $table->integer('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('email');
        });
        $this->db->schema()->create('pending_users', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('provider', 50);
            $table->string('identifier', 50);
            $table->string('token');
            $table->text('fields')->nullable();
            $table->timestamps();
            $table->unique(['provider', 'identifier']);
            $table->index('token');
        });
        $this->db->schema()->create('projects', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('chapter')->nullable();
            $table->string('code')->nullable();
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->string('author_names');
            $table->string('author_surnames');
            $table->string('author_dni');
            $table->string('author_phone')->nullable();
            $table->string('author_email')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('organization_address')->nullable();
            $table->text('objective')->nullable();
            $table->text('field_values')->default('[]');
            $table->text('budget')->nullable();
            $table->decimal('budget_total')->default(0);
            $table->string('picture_name')->nullable();
            $table->string('youtube_id')->nullable();
            $table->text('admin_notes')->nullable();
            $table->boolean('feasible')->nullable();
            $table->text('feasibility')->nullable();
            $table->boolean('selected')->default(false);
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('project_states');
            $table->integer('final_votes')->default(0);
            $table->boolean('hidden')->default(false);
            $table->string('trace')->nullable();
            $table->text('journal')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('title');
        });
        $this->db->schema()->create('project_fields', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('chapter')->nullable();
            $table->text('fields');
            $table->text('required')->default("[]");
            $table->text('layout')->default("[]");
            $table->text('private')->default("[]");
            $table->boolean('enable_budget');
            $table->boolean('enable_detailed_budget');
            $table->integer('budget_limit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        $this->db->schema()->create('project_states', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('chapter')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
        });
        $this->db->schema()->create('documents', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('filename')->nullable();
            $table->text('description')->nullable();
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
        $this->db->schema()->create('project_entries', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->date('date');
            $table->text('statement');
            $table->boolean('hidden')->default(false);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });
        $this->db->schema()->create('project_entries_files', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_entry_id')->unsigned();
            $table->string('name');
            $table->string('filename');
            $table->string('mime');
            $table->text('description')->nullable();
            $table->boolean('hidden')->default(false);
            $table->foreign('project_entry_id')->references('id')->on('project_entries');
            $table->timestamps();
        });
        $this->db->schema()->create('project_entries_images', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_entry_id')->unsigned();
            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('mime');
            $table->text('description')->nullable();
            $table->boolean('hidden')->default(false);
            $table->foreign('project_entry_id')->references('id')->on('project_entries');
            $table->timestamps();
        });

        // $this->db->schema()->create('votes', function ($table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id');
        //     $table->string('hash');
        //     $table->integer('project_id')->unsigned();
        //     $table->foreign('project_id')->references('id')->on('projects');
        // });
        // $this->db->schema()->create('comments', function ($table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id');
        //     $table->text('content');
        //     $table->integer('votes')->default(0);
        //     $table->text('meta')->nullable();
        //     $table->integer('project_id')->nullable()->unsigned();
        //     $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        //     $table->integer('author_id')->unsigned();
        //     $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->integer('parent_id')->unsigned()->nullable();
        //     $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        // $this->db->schema()->create('comment_votes', function ($table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id');
        //     $table->integer('value');
        //     $table->integer('user_id')->unsigned();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->integer('comment_id')->unsigned();
        //     $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        //     $table->timestamps();
        // });
        $this->db->schema()->create('actions', function ($table) {
            $table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('group');
            $table->string('allowed_roles');
            $table->string('allowed_relations');
            $table->string('allowed_proxies');
            $table->timestamps();
        });
        $this->db->schema()->create('page_blocks', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 500);
            $table->text('markdown');
            $table->string('path');
            $table->string('picture_name')->nullable();
            $table->boolean('hidden')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        // $this->db->schema()->create('pages', function ($table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('link')->nullable();
        //     $table->text('meta')->nullable();
        //     //$table->json('meta')->nullable();
        //     $table->string('slug');
        //     $table->integer('order')->default(0);
        //     $table->integer('parent_id')->unsigned()->nullable();
        //     $table->foreign('parent_id')->references('id')->on('pages')->onDelete('set null');
        // });
        $this->db->schema()->create('offline_ballots', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order');
            $table->boolean('invalid')->default(true);
            $table->timestamps();
        });
        $this->db->schema()->create('offline_votes', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('ballot_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('ballot_id')->references('id')->on('offline_ballots')->onDelete('cascade');
        });

         $this->db->schema()->create('online_ballots', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 10)->nullable();
            $table->timestamp('created_at');
            $table->boolean('sent')->nullable(); // false -> invalid
        });
        $this->db->schema()->create('online_votes', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('hash');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
        });

        $this->db->schema()->create('statistical_ballots', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type'); // user, link, tablet, paper
            $table->string('gender')->nullable;
            $table->integer('age')->nullable();
            $table->timestamps();
        });
        $this->db->schema()->create('audit_trails', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('file_name');
            $table->string('state');
            $table->string('description');
            $table->text('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->db->schema()->dropAllTables();
    }

    public function populate($data)
    {
        $this->db->table('roles')->insert([
            [
                'id' => 'user',
                'name' => 'Usuario',
            ], [
                'id' => 'verified',
                'name' => 'Verificado',
            ], [
                'id' => 'admin',
                'name' => 'Admnistrador',
            ],
        ]);

        $this->db->table('options')->insert([
            [
                'key' => 'budget-title',
                'value' => $data['budgetName'],
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'budget-description',
                'value' => $data['budgetDescription'],
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'email-contact',
                'value' => $data['contactEmail'],
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-web',
                'value' => $data['social']['web'] ?? null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-facebook',
                'value' => $data['social']['facebook'] ?? null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-twitter',
                'value' => $data['social']['twitter'] ?? null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-instagram',
                'value' => $data['social']['instagram'] ?? null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-youtube',
                'value' => $data['social']['youtube'] ?? null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enable-google-analytics',
                'value' => $data['enableGoogleAnalytics'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'google-analytics-id',
                'value' => $data['googleAnalyticsId'],
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enable-facebook-sharer',
                'value' => $data['enableFacebookApp'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'facebook-app-id',
                'value' => $data['facebookAppId'],
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'current-chapter',
                'value' => 2020,
                'type' => 'integer',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'current-state',
                // 'value' => 'pre-upload-proposals',
                'value' => 'upload-proposals',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'states',
                'value' => "[{\"key\":\"pre-upload-proposals\",\"name\":\"Pre-Propuestas\"},{\"key\":\"upload-proposals\",\"name\":\"Subida Propuestas\"},{\"key\":\"pre-vote\",\"name\":\"Pre-Votación\"},{\"key\":\"vote\",\"name\":\"Votación\"},{\"key\":\"pre-results\",\"name\":\"Pre-Resultados\"},{\"key\":\"results\",\"name\":\"Resultados\"}]",
                'type' => 'object',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'proposals-launch',
                'value' => $data['proposalLaunchDatetime'],
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'proposals-deadline',
                'value' => $data['proposalClosingDatetime'],
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'proposals-available',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],  
            [
                'key' => 'vote-launch',
                'value' => $data['votingLaunchDatetime'],
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'vote-deadline',
                'value' => $data['votingClosingDatetime'],
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'vote-available',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enableElectoralRoll',
                'value' =>  $data['enableElectoralRoll'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enableVotesPerBallot',
                'value' =>  $data['enableVotesPerBallot'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votesPerBallot',
                'value' =>  $data['votesPerBallot'] ?? null,
                'type' => 'integer',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enableVotesPerType',
                'value' =>  $data['enableVotesPerType'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votesPerType',
                'value' =>  $data['votesPerType'] ? json_encode($data['votesPerType']) : null,
                'type' => 'object',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteMobile',
                'value' =>  $data['voteMobile'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteRemote',
                'value' =>  $data['voteRemote'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votePhysical',
                'value' =>  $data['votePhysical'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteInPlace',
                'value' =>  $data['voteInPlace'],
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'calendar',
                'value' => '[]',
                'type' => 'object',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'rain-message',
                'value' => 'En caso de lluvia, podes encontrarnos en (a redactar)',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'admin-message',
                'value' => 'Este mensaje se muestra cuando se tiene que informar de una necesidad',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'show-admin-notification',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'last-scrutiny',
                'value' => null,
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
        ]);

        $categoriesInsert = array();
        foreach($data['types'] as $index => $type){
            $row = array("id" => $index + 1, "key" => $type['id'], "name" => $type['name'], "fontawesome_icon" => $type['fontawesome_icon']);
            $categoriesInsert[] = $row;
        }
        $this->db->table('categories')->insert($categoriesInsert);

        $districtInsert = array();
        foreach ($data['districts'] as $index => $district) {
            $row = array("id" => $index + 1, "name" => $district);
            $districtInsert[] = $row;
        }
        $this->db->table('districts')->insert($districtInsert);

        $neighbourhoodsInsert = array();
        foreach($data['neighbourhoods'] as $index => $neighbourhood){
            $row = array("id" => $index + 1, "district_id" => intval($neighbourhood['district']) + 1, "name" => $neighbourhood['name']);
            $neighbourhoodsInsert[] = $row;
        }
        $this->db->table('neighbourhoods')->insert($neighbourhoodsInsert);
        

        $this->db->table('project_fields')->insert([
            [
                'id' => 1,
                'chapter' => Carbon::now()->format('Y'),
                'fields' => json_encode($data['projectFields']),
                'required' => json_encode($data['projectFieldsRequired']),
                'private' => json_encode($data['projectFieldsPrivate']),
                'layout' => json_encode($data['projectFieldsLayout']),
                'enable_budget' => $data['enableBudget'] ? true : false,
                'enable_detailed_budget' => $data['enableDetailedBudget'] ? true : false,
                'budget_limit' => $data['budgetLimit'] ?? null
            ],
        ]);
        $this->db->table('subjects')->insert([
            [
                'id' => 1,
                'display_name' => 'Presupuesto Admin',
                'img_type' => 0,
                'img_hash' => md5($data['admin']['email']),
                'points' => 0,
                'type' => 'User',
                'trace' => 'PresupuestoAdmin',
                'citizen_id' => null,
                'neighbourhood_id' => null,
            ],
        ]);

        $this->db->table('users')->insert([
            [
                'id' => 1,
                'email' => $data['admin']['email'],
                'password' => password_hash($data['admin']['password'], PASSWORD_DEFAULT),
                'names' => 'Presupuesto',
                'surnames' => 'Admin',
                'dni' => '99999999',
                'birthday' => '1900-01-01 01:00:00',
                'subject_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ]);
        $this->db->table('subject_role')->insert([
            [
                'id' => 1,
                'subject_id' => 1,
                'role_id' => 'user',
            ],
            [
                'id' => 2,
                'subject_id' => 1,
                'role_id' => 'admin',
            ],
        ]);
    }
}