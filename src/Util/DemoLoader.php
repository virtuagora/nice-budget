<?php namespace App\Util;

use Carbon\Carbon;

class DemoLoader
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate()
    {
        $proposalsLaunch = Carbon::now();
        $proposalsLaunch = $proposalsLaunch->add(7, 'day');
        $proposalsCloses = Carbon::now();
        $proposalsCloses = $proposalsCloses->add(14,'day');
        $votingLaunch = Carbon::now();
        $votingLaunch = $votingLaunch->add(30, 'day');
        $votingCloses = Carbon::now();
        $votingCloses = $votingCloses->add(60,'day');
        $votingRules = [
            'salud-bienestar' => 1,
            'deporte' => 2,
            'espacios-verde' => 1,
            'cultura-recreacion' => 3,
        ];
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
                'value' => 'Construyendo Villavicencio',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'budget-description',
                'value' => 'Le descriptione da platafurm. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex maiores libero veritatis est quam aperiam consectetur obcaecati, at facilis, ut ab totam delectus.', 
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'email-contact',
                'value' => 'presupuesto@demo.com',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-web',
                'value' => 'villavicencio-demo.com',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-facebook',
                'value' => null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-twitter',
                'value' => 'villavicencio',
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-instagram',
                'value' => null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'social-youtube',
                'value' => null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enable-google-analytics',
                'value' => false,
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'google-analytics-id',
                'value' => null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enable-facebook-sharer',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'facebook-app-id',
                'value' => null,
                'type' => 'string',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'current-state',
                'value' => 'pre-upload-proposals',
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
                'value' => $proposalsLaunch,
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'proposals-deadline',
                'value' => $proposalsCloses,
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
                'value' => $votingLaunch,
                'type' => 'date',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'vote-deadline',
                'value' => $votingCloses,
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
                'key' => 'enable-budget-limit',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'budget-limit',
                'value' =>  '1000000',
                'type' => 'integer',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enableVotesPerBallot',
                'value' =>  'false',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votesPerBallot',
                'value' =>  null,
                'type' => 'integer',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'enableVotesPerType',
                'value' =>  'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votesPerType',
                'value' =>  json_encode($votingRules),
                'type' => 'object',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteMobile',
                'value' =>  'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteRemote',
                'value' =>  'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'votePhysical',
                'value' =>  'true',
                'type' => 'boolean',
                'group' => 'varios',
                'autoload' => true,
            ],
            [
                'key' => 'voteInPlace',
                'value' =>  'true',
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

        $this->db->table('categories')->insert([
            ['id' => 1, 'key' => 'salud-bienestar', 'name' => 'Salud y bienestar'],
            ['id' => 2, 'key' => 'deporte', 'name' => 'Deportes'],
            ['id' => 3, 'key' => 'espacios-verde', 'name' => 'Espacios verdes'],
            ['id' => 4, 'key' => 'cultura-recreacion', 'name' => 'Cultura y recreacion'],
        ]);
        $this->db->table('districts')->insert([
            ['id' => 1, 'name' => 'Norte'],
            ['id' => 2, 'name' => 'Centro'],
            ['id' => 3, 'name' => 'Sur']
        ]);
        $this->db->table('neighbourhoods')->insert([
            ['id' => 1, 'district_id' => 1, 'name' => 'Norte'],
            ['id' => 2, 'district_id' => 1, 'name' => 'Diaz Velez'],
            ['id' => 3, 'district_id' => 1, 'name' => 'Islas Malvinas'],
            ['id' => 4, 'district_id' => 1, 'name' => 'El Pino'],
            ['id' => 5, 'district_id' => 1, 'name' => 'Capitán Bermudez'],
            ['id' => 6, 'district_id' => 1, 'name' => '3 de Febrero'],
            ['id' => 7, 'district_id' => 1, 'name' => 'Fonavi Oeste'],
            ['id' => 8, 'district_id' => 1, 'name' => 'Las Quintas'],
            ['id' => 9, 'district_id' => 3, 'name' => 'Mitre'],
            ['id' => 10, 'district_id' => 2, 'name' => 'Oroño'],
            ['id' => 11, 'district_id' => 2, 'name' => 'Alem'],
            ['id' => 12, 'district_id' => 2, 'name' => 'S.U.P.E.'],
            ['id' => 13, 'district_id' => 2, 'name' => 'Remedios de Escalada'],
            ['id' => 14, 'district_id' => 2, 'name' => 'Del combate'],
            ['id' => 15, 'district_id' => 2, 'name' => 'Santiago Cabral'],
            ['id' => 16, 'district_id' => 2, 'name' => '17 de Agosto'],
            ['id' => 17, 'district_id' => 2, 'name' => '1° de Julio'],
            ['id' => 18, 'district_id' => 2, 'name' => 'San Martin'],
            ['id' => 19, 'district_id' => 3, 'name' => 'M. Moreno'],
            ['id' => 20, 'district_id' => 3, 'name' => 'José Hernandez'],
            ['id' => 21, 'district_id' => 3, 'name' => 'Villa Felisa'],
            ['id' => 22, 'district_id' => 3, 'name' => 'Rivadavia'],
            ['id' => 23, 'district_id' => 3, 'name' => 'Bouchard'],
            ['id' => 24, 'district_id' => 3, 'name' => 'Morando'],
            ['id' => 25, 'district_id' => 3, 'name' => '2 de Abríl'],
            ['id' => 26, 'district_id' => 3, 'name' => 'San Eduardo']
        ]);
        $this->db->table('citizens')->insert([
            ['id' => 1, 'table' => 7620, 'order' => 1, 'dni' => 12345601, 'fullname' => 'Sussie Moreno', 'year' => 1964, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 2, 'table' => 7620, 'order' => 2, 'dni' => 12345602, 'fullname' => 'Marcos Ceballos', 'year' => 1952, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'M'],
            ['id' => 3, 'table' => 7620, 'order' => 3, 'dni' => 12345603, 'fullname' => 'Bella Alem', 'year' => 1989, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 4, 'table' => 7620, 'order' => 4, 'dni' => 12345604, 'fullname' => 'Javier Curtivas', 'year' => 1972, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'M'],
            ['id' => 5, 'table' => 7620, 'order' => 5, 'dni' => 12345605, 'fullname' => 'Penny Sarmiento', 'year' => 1994, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 6, 'table' => 7620, 'order' => 6, 'dni' => 12345606, 'fullname' => 'Carla Mitre', 'year' => 1984, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 7, 'table' => 7620, 'order' => 7, 'dni' => 12345607, 'fullname' => 'Valeria Gonzales', 'year' => 1969, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 8, 'table' => 7620, 'order' => 8, 'dni' => 12345608, 'fullname' => 'Anabella Perez', 'year' => 1989, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'F'],
            ['id' => 9, 'table' => 7620, 'order' => 9, 'dni' => 12345609, 'fullname' => 'Jose Freyre', 'year' => 1994, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'M'],
            ['id' => 10, 'table' => 7620, 'order' => 10, 'dni' => 12345610, 'fullname' => 'Carlos Urquiza', 'year' => 1920, 'data' => json_encode(['tipo' =>  'DNI-EA', 'domicilio' => 'Calle Demo 123']), 'genre' => 'M'],
        ]);

        $this->db->table('subjects')->insert([
            [
                'id' => 1,
                'display_name' => 'Virtuagora Admin',
                'img_type' => 0,
                'img_hash' => md5('admin@virtuagora.org'),
                'points' => 0,
                'type' => 'User',
                'trace' => 'VirtuagoraAdmin',
                'citizen_id' => null,
                'neighbourhood_id' => 8,
            ],
            [
                'id' => 2,
                'display_name' => 'Mariano Olivera',
                'img_type' => 0,
                'img_hash' => md5('usuario@virtuagora.org'),
                'points' => 0,
                'type' => 'User',
                'trace' => 'MarianoOlivera',
                'citizen_id' => null,
                'neighbourhood_id' => 2,
            ],
            [
                'id' => 3,
                'display_name' => 'Sussie Moreno',
                'img_type' => 0,
                'img_hash' => md5('ciudadano@virtuagora.org'),
                'points' => 0,
                'type' => 'User',
                'trace' => 'SussieMoreno',
                'citizen_id' => 1,
                'neighbourhood_id' => 4,
            ],
        ]);
        $this->db->table('users')->insert([
            [
                'id' => 1,
                'email' => 'admin@virtuagora.org',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'names' => 'Virtuagora',
                'surnames' => 'Admin',
                'dni' => '99999999',
                'birthday' => '1992-06-30 06:00:00',
                'subject_id' => 1,
            ],
            [
                'id' => 2,
                'email' => 'usuario@virtuagora.org',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'names' => 'Mariano',
                'surnames' => 'Olivera',
                'dni' => '35358625',
                'birthday' => '1992-04-20 00:00:00',
                'subject_id' => 2,
            ],
            [
                'id' => 3,
                'email' => 'ciudadano@virtuagora.org',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'names' => 'Maria',
                'surnames' => 'Pelen',
                'dni' => '31205541',
                'birthday' => '1992-08-20 00:00:00',
                'subject_id' => 3,
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
            [
                'id' => 3,
                'subject_id' => 2,
                'role_id' => 'user',
            ],
            [
                'id' => 4,
                'subject_id' => 3,
                'role_id' => 'user',
            ],
            [
                'id' => 5,
                'subject_id' => 3,
                'role_id' => 'verified',
            ],
        ]);
        $this->db->table('projects')->insert(
            [
                [
                    'id' => 1,
                    'code' => '2020/1',
                    'name' => 'Hospitales en marcha',
                    'category_id' => 1,
                    'district_id' => 2,
                    'description' => 'Die descripcion le tu quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.',
                    'objective' => 'Die objetive se mu suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.',
                    'benefited_population' => 'Le benefite poblationate quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.',
                    'community_contributions' => 'No tiene aportes comunitarios',
                    'budget' => '"[{"description":"Quisque in ultrices lectus","amount":13000},{"Proin sodales lobortis libero eu facilisis":"ASDFGHHJ","amount":10000},{"description":"In sem urna, aliquam vel","amount":10000}]"',
                    'total_budget' => 33000,
                    'author_names' => 'Sussie',
                    'author_surnames' => 'Moreno',
                    'author_phone' => '3422211151',
                    'author_email' => 'itsanemail@demo.com',
                    'author_dni' => '12345601',
                    'organization_name' => null,
                    'organization_legal_entity' => null,
                    'organization_address' => null,
                    'feasibility' => 'Le comentarie da feasibilidad due lemenrt',
                    'journal' => '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1},\"1564371973\":{\"name\":\"Plazas roboticas\",\"type\":\"comunitario\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":7}}',
                    'notes' => null,
                    'picture_name' => null,
                    'youtube_id' => null,
                    'public' => 1,
                    'feasible' => 1,
                    'selected' => 0,
                    'likes' => 0,
                    'trace' => 'PlazasRoboticas',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
                [
                    'id' => 2,
                    'code' => '2020/2',
                    'name' => 'Maternidad en acción para todxs',
                    'category_id' => 1,
                    'district_id' => 3,
                    'description' => 'Die descripcion le tu quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.',
                    'objective' => 'Die objetive se mu suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.',
                    'benefited_population' => 'Le benefite poblationate quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.',
                    'community_contributions' => 'No tiene aportes comunitarios',
                    'budget' => '"[{"description":"Quisque in ultrices lectus","amount":13000},{"Proin sodales lobortis libero eu facilisis":"ASDFGHHJ","amount":10000},{"description":"In sem urna, aliquam vel","amount":10000}]"',
                    'total_budget' => 33000,
                    'author_names' => 'Sussie',
                    'author_surnames' => 'Moreno',
                    'author_phone' => '3422211151',
                    'author_email' => 'itsanemail@demo.com',
                    'author_dni' => '12345601',
                    'organization_name' => null,
                    'organization_legal_entity' => null,
                    'organization_address' => null,
                    'feasibility' => 'Le comentarie da feasibilidad due lemenrt',
                    'journal' => '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1},\"1564371973\":{\"name\":\"Plazas roboticas\",\"type\":\"comunitario\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":7}}',
                    'notes' => null,
                    'picture_name' => null,
                    'youtube_id' => null,
                    'public' => 1,
                    'feasible' => 1,
                    'selected' => 0,
                    'likes' => 0,
                    'trace' => 'MaternidadEnAccionParaTodxs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
                [
                    'id' => 3,
                    'code' => '2020/3',
                    'name' => 'Deporte y valores sin fronteras',
                    'category_id' => 2,
                    'district_id' => 1,
                    'description' => 'Die descripcion le tu quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.',
                    'objective' => 'Die objetive se mu suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.',
                    'benefited_population' => 'Le benefite poblationate quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.',
                    'community_contributions' => 'No tiene aportes comunitarios',
                    'budget' => '"[{"description":"Quisque in ultrices lectus","amount":13000},{"Proin sodales lobortis libero eu facilisis":"ASDFGHHJ","amount":10000},{"description":"In sem urna, aliquam vel","amount":10000}]"',
                    'total_budget' => 33000,
                    'author_names' => 'Juan Sebastian',
                    'author_surnames' => 'Pereira',
                    'author_phone' => '3422211151',
                    'author_email' => 'itsanemail@demo.com',
                    'author_dni' => '65432101',
                    'organization_name' => null,
                    'organization_legal_entity' => null,
                    'organization_address' => null,
                    'feasibility' => 'Le comentarie da feasibilidad due lemenrt',
                    'journal' => '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1},\"1564371973\":{\"name\":\"Plazas roboticas\",\"type\":\"comunitario\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":7}}',
                    'notes' => null,
                    'picture_name' => null,
                    'youtube_id' => null,
                    'public' => 1,
                    'feasible' => 1,
                    'selected' => 0,
                    'likes' => 0,
                    'trace' => 'DeportesYValoresSinFronteras',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
            ]
        );
    }
}

# id, code, name, type, slug, district_id, description, objective, benefited_population, community_contributions, budget, total_budget, author_names, author_surnames, author_phone, author_email, author_dni, organization_name, organization_legal_entity, organization_address, feasibility, journal, notes, picture_name, youtube_id, public, feasible, selected, likes, trace, author_id, created_at, updated_at, deleted_at
// 'id'=>'1', 'code'=> 'NC/1', 'name' => 'Plazas roboticas', 'comunitario', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000},{\"description\":\"Woops\",\"amount\":2000}]', '35000.00', 'Susana', 'Acosta', '154782161', 'fake@gmail.com', '10371916', NULL, NULL, NULL, 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1},\"1564371973\":{\"name\":\"Plazas roboticas\",\"type\":\"comunitario\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":7}}', NULL, '1.jpg', NULL, '1', '1', '1', '3', 'Plazasroboticas', '7', '2019-07-28 19:15:13', '2019-09-09 12:39:41', NULL
// 'id'=>'2', 'code'=> 'NC/2', 'name' => 'Hospitales andantes', 'comunitario', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Juan', 'Alberto', '154782161', 'fake@gmail.com', '352616401', NULL, NULL, NULL, 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '1', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'3', 'code'=> 'NC/3', 'name' => 'San Lorenzo Segura', 'comunitario', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Francisco', 'Juan', '154782161', 'fake@gmail.com', '352616402', NULL, NULL, NULL, 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, '3.jpg', NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-08-14 02:30:26', NULL
// 'id'=>'4', 'code'=> 'NI/4', 'name' => 'Comprendiendo con la escuela y los chicos', 'institucional', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Miriam', 'Ceballos', '154782161', 'fake@gmail.com', '352616403', 'Organizacion Nueva', 'Nueva Organizacion Keest', 'Salvador 2927', 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '3', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'5', 'code'=> 'NI/5', 'name' => 'Jugando con acuarelas', 'institucional', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Pedro', 'Villareal', '154782161', 'fake@gmail.com', '352616404', 'Agrupacion Nueva Vida', 'Nueva vida', 'Paraninfo 2929', 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, '5.jpg', NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-08-14 02:30:07', NULL
// 'id'=>'6', 'code'=> 'NI/6', 'name' => 'Semaforos para ciegos', 'institucional', NULL, '1', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Javier', 'Camarion', '154782161', 'fake@gmail.com', '352616405', 'Las Heras', 'Las heras SFT', 'Samariton 887', 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '1', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'7', 'code'=> 'CC/7', 'name' => 'Nueva sede de la ciudad', 'comunitario', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Francisco', 'Pepe', '154782161', 'fake@gmail.com', '352616406', NULL, NULL, NULL, NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '2', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'8', 'code'=> 'CC/8', 'name' => 'Puesto saludable', 'comunitario', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Javier', 'Lorenzo', '154782161', 'fake@gmail.com', '352616407', NULL, NULL, NULL, 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 23:49:21', NULL
// 'id'=>'9', 'code'=> 'CC/9', 'name' => 'Venta de comida verde y saludable', 'comunitario', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Juan', 'Cepso', '154782161', 'fake@gmail.com', '352616408', NULL, NULL, NULL, 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 23:49:29', NULL
// 'id'=>'10', 'code'=> 'CI/10', 'name' => 'Paraninfo de la educacion', 'institucional', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Carla', 'Ceballos', '154782161', 'fake@gmail.com', '352616409', 'Superpoderosas', 'ONG Por las chicas', 'Salvador 2927', 'Proyecto factible para participar de la votación, ¡Felicidades!', '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '2', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'11', 'code'=> 'CI/11', 'name' => 'Arte y vida', 'institucional', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Pedro', 'Lorenzo', '154782161', 'fake@gmail.com', '352616410', 'Grupo Sonido', 'Sonido Nuevo', 'Paraninfo 2929', NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 19:15:13', NULL
// 'id'=>'12', 'code'=> 'CI/12', 'name' => 'Payamedicos Acertivos', 'institucional', NULL, '2', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Patricio', 'Upsilon', '154782161', 'fake@gmail.com', '352616411', 'Ellas tambien', 'Ellas GROUP', 'Samariton 887', NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 19:15:13', NULL
// 'id'=>'13', 'code'=> 'SC/13', 'name' => 'Lluvia de corazones!', 'comunitario', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Francisco', 'Pepe', '154782161', 'fake@gmail.com', '352616406', NULL, NULL, NULL, NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '2', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'14', 'code'=> 'SC/14', 'name' => 'Cumbia infantil para vivir mejor', 'comunitario', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Javier', 'Lorenzo', '154782161', 'fake@gmail.com', '352616407', NULL, NULL, NULL, NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 19:15:13', NULL
// 'id'=>'15', 'code'=> 'SC/15', 'name' => 'Conciertos en la plaza', 'comunitario', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Juan', 'Cepso', '154782161', 'fake@gmail.com', '352616408', NULL, NULL, NULL, NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '1', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'16', 'code'=> 'SI/16', 'name' => 'Educacion sexual en las secundarias', 'institucional', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Carla', 'Ceballos', '154782161', 'fake@gmail.com', '352616409', 'Veganos a la marcha', 'VeggieForTheWin', 'Salvador 2927', NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '1', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
// 'id'=>'17', 'code'=> 'SI/17', 'name' => 'Muestra de arte y cultura de San Lorenzo Capitulo 1', 'institucional', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Pedro', 'Lorenzo', '154782161', 'fake@gmail.com', '352616410', 'Familia al volante', 'Grupo Real Vida', 'Paraninfo 2929', NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '0', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-07-28 19:15:13', NULL
// 'id'=>'18', 'code'=> 'SI/18', 'name' => 'Escuela de Skaters - Vivi con onda', 'institucional', NULL, '3', 'Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.', 'Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.', 'Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.', 'Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.', '[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}]', '33000.00', 'Patricio', 'Upsilon', '154782161', 'fake@gmail.com', '352616411', 'Organizacion verde', 'Amigos por las mascotas', 'Samariton 887', NULL, '{\"1564352113\":{\"name\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\",\"type\":\"comunitario\",\"objective\":\"Suspendisse a sodales nulla, sed semper nisi. Cras lobortis volutpat nunc. Proin tincidunt enim in felis aliquet, a ultricies purus bibendum.\",\"description\":\"Quisque in ultrices lectus. Nulla at urna diam. Proin sodales lobortis libero eu facilisis. In sem urna, aliquam vel consectetur sit amet, pulvinar sit amet lectus.\",\"benefited_population\":\"Quisque molestie dapibus libero non pellentesque. Vivamus quam arcu, dictum quis hendrerit eget, lobortis eu felis. Nulla felis velit, ornare ac porttitor ut, rhoncus eu ipsum.\",\"community_contributions\":\"Donec auctor efficitur est vel congue. Nunc at nunc quis massa facilisis fermentum. Vivamus fringilla nunc vitae justo consectetur, aliquam gravida nisl mollis.\",\"budget\":[{\"description\":\"QWER\",\"amount\":13000},{\"description\":\"ASDFGHHJ\",\"amount\":10000},{\"description\":\"TJUSNCIDNM\",\"amount\":10000}],\"author_id\":1}}', NULL, NULL, NULL, '1', '1', '0', '1', 'Loremipsumdolorsitametconsecteturadipiscingelit', NULL, '2019-07-28 19:15:13', '2019-09-09 12:31:08', NULL
