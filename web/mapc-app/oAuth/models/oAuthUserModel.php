<?php
namespace Mapc\oAuth;

use OAuth2\Storage\UserCredentialsInterface;
use OAuth2\Storage\Pdo;

class oAuthUser extends oAuthLogin {
    /**
     * Grant access tokens for basic user credentials.
     *
     * Check the supplied username and password for validity.
     *
     * You can also use the $client_id param to do any checks required based
     * on a client, if you need that.
     *
     * Required for OAuth2::GRANT_TYPE_USER_CREDENTIALS.
     *
     * @param $username
     * Username to be check with.
     * @param $password
     * Password to be check with.
     *
     * @return
     * TRUE if the username and password are valid, and FALSE if it isn't.
     * Moreover, if the username and password are valid, and you want to
     *
     * @see http://tools.ietf.org/html/rfc6749#section-4.3
     *
     * @ingroup oauth2_section_4
     */
    public function checkUserCredentials($username, $password)
    {
        // TODO: Implement checkUserCredentials() method.
    }

    public function getUserDetails($username)
    {
        // TODO: Implement getUserDetails() method.
        $stmt = $this->db->prepare($sql = sprintf('SELECT * from %s where user_id=:username', $this->config['user_table']));
        $stmt->execute(array(':username' => $username));

        if (!$userInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }

        // the default behavior is to use "username" as the user_id
        return array_merge(array(
            'user_id' => $username
        ), $userInfo);
    }
}