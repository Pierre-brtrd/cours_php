<?php

include_once('/app/config/mysql.php');

/**
 * Find all user in database
 *
 * @return array Array of users with all informations
 */
function findAllUsers(): array
{
    global $db;

    $query = 'SELECT * FROM users';

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

/**
 * Find a user by id
 *
 * @param integer $id Id of the user to find
 * @return array|boolean
 */
function findUserById(int $id): array|bool
{
    global $db;

    $query = "SELECT id, nom, prenom, email, roles, image FROM users WHERE id = :id";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute([
        'id' => $id
    ]);

    return $sqlStatement->fetch();
}

/**
 * Find a user in database with the email address
 *
 * @param string $email the email to search in db
 * @return array|boolean
 */
function findUserByEmail(string $email): array|bool
{
    global $db;

    $query = "SELECT * FROM users WHERE email = :email";
    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute([
        'email' => $email
    ]);

    return $sqlStatement->fetch();
}

/**
 * Add a user to the database
 *
 * @author Pierre Bertrand  <email@email.com>
 * 
 * @param string $nom LastName of the user
 * @param string $prenom FirstName of the user
 * @param string $email Email of the user
 * @param string $plainPassord Plain password (will be hashed)
 * @param array $roles Permissions for the user - Default 'ROLE_USER'
 * @return boolean
 */
function addUser(string $nom, string $prenom, string $email, string $plainPassord, array $roles = ['ROLE_USER'], ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "INSERT INTO users(nom, prenom, email, password, roles, image) VALUE (:nom, :prenom, :email, :password, :roles, :image)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => password_hash($plainPassord, PASSWORD_ARGON2I),
                'roles' => json_encode($roles),
                'image' => $image,
            ]);
        } else {
            $query = "INSERT INTO users(nom, prenom, email, password, roles) VALUE (:nom, :prenom, :email, :password, :roles)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => password_hash($plainPassord, PASSWORD_ARGON2I),
                'roles' => json_encode($roles)
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

/**
 * Update a user with form information (password exempted)
 *
 * @param integer $id Id of the user to update
 * @param string $nom LastName of the user to update
 * @param string $prenom FirstName of the user to update
 * @param string $email Email of the user to update
 * @param array $roles Roles of the user to update
 * @return boolean
 */
function updateUser(int $id, string $nom, string $prenom, string $email, array $roles = ['ROLE_USER'], ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "UPDATE users SET nom= :nom, prenom= :prenom, email= :email, roles= :roles, image= :image WHERE id= :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'roles' => json_encode($roles),
                'image' => $image,
            ]);
        } else {
            $query = "UPDATE users SET nom= :nom, prenom= :prenom, email= :email, roles= :roles WHERE id= :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'roles' => json_encode($roles)
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

/**
 * Delete a user with the given id from the database
 *
 * @param integer $id Id of the user to delete
 * @return boolean
 */
function deleteUser(int $id): bool
{
    global $db;

    try {
        $query = "DELETE FROM users WHERE id = :id";
        $sqlStatement = $db->prepare($query);
        $sqlStatement->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}
