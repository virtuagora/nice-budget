<?php namespace App\Util;

use Carbon\Carbon;

class UsersDemoLoader
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate()
    {
      $this->db->table('citizens')->insert([
            ['id' => 1, 'table' => 7620, 'order' => 1, 'dni' => 12345601, 'year' => 1964, 'data' => json_encode(['name' => 'Sussie', 'surname' => 'Moreno']), 'genre' => 'F'],
            ['id' => 2, 'table' => 7620, 'order' => 2, 'dni' => 12345602, 'year' => 1952, 'data' => json_encode(['name' => 'Marcos', 'surname' => 'Ceballos']), 'genre' => 'M'],
            ['id' => 3, 'table' => 7620, 'order' => 3, 'dni' => 12345603, 'year' => 1989, 'data' => json_encode(['name' => 'Bella', 'surname' => 'Alem']), 'genre' => 'F'],
            ['id' => 4, 'table' => 7620, 'order' => 4, 'dni' => 12345604, 'year' => 1972, 'data' => json_encode(['name' => 'Javier', 'surname' => 'Curtivas']), 'genre' => 'M'],
            ['id' => 5, 'table' => 7620, 'order' => 5, 'dni' => 12345605, 'year' => 1994, 'data' => json_encode(['name' => 'Penny', 'surname' => 'Sarmiento']), 'genre' => 'F'],
            ['id' => 6, 'table' => 7620, 'order' => 6, 'dni' => 12345606, 'year' => 1984, 'data' => json_encode(['name' => 'Carla', 'surname' => 'Mitre']), 'genre' => 'F'],
            ['id' => 7, 'table' => 7620, 'order' => 7, 'dni' => 12345607, 'year' => 1969, 'data' => json_encode(['name' => 'Valeria', 'surname' => 'Gonzales']), 'genre' => 'F'],
            ['id' => 8, 'table' => 7620, 'order' => 8, 'dni' => 12345608, 'year' => 1989, 'data' => json_encode(['name' => 'Anabella', 'surname' => 'Perez']), 'genre' => 'F'],
            ['id' => 9, 'table' => 7620, 'order' => 9, 'dni' => 12345609, 'year' => 1994, 'data' => json_encode(['name' => 'Jose', 'surname' => 'Freyre']), 'genre' => 'M'],
            ['id' => 10, 'table' => 7620, 'order' => 10, 'dni' => 12345610, 'year' => 1920, 'data' => json_encode(['name' => 'Carlos', 'surname' => 'Urquiza']), 'genre' => 'M'],
        ]);

        $this->db->table('subjects')->insert([
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
                'neighbourhood_id' => 3,
            ],
        ]);
        $this->db->table('users')->insert([
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
                'names' => 'Sussie',
                'surnames' => 'Moreno',
                'dni' => '31205541',
                'birthday' => '1992-08-20 00:00:00',
                'subject_id' => 3,
            ],
        ]);
        $this->db->table('subject_role')->insert([
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
    }
}



