<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
/*
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'user_id'    => $faker->unique(),
                'name'       => $faker->firstName . " " . $faker->lastName,
                'email'      => $faker->email,
                'password'   => $faker->password,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            ];
        }
        $users = $this->table('users');
        $users->insert($data)->save();
*/
        $data[] = [
            'uuid'    => 'usr_000',
            'firstname'  => 'Anne',
            'lastname' => 'Anderson',
            'email'      => 'anne@example.com',
            'password'   => password_hash('1234pass',PASSWORD_BCRYPT),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s"),
            'inactive' => 0,
        ];
        $data[] = [
            'uuid'    => 'usr_001',
            'firstname'       => 'Ben',
            'lastname' => ' Bennett',
            'email'      => 'ben@example.com',
            'password'   => password_hash('1234pass',PASSWORD_BCRYPT),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s"),
            'inactive' => 0,
        ];
        $data[] = [
            'uuid'    => 'usr_002',
            'firstname'       => 'Chris',
            'lastname'  => 'Christensen',
            'email'      => 'chris@example.com',
            'password'   => password_hash('1234pass',PASSWORD_BCRYPT),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s"),
            'inactive' => 0,
        ];

        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
