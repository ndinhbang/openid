<?php
/**
 * EGroupware OpenID Connect / OAuth2 server
 *
 * @link https://www.egroupware.org
 * @author Ralf Becker <rb-At-egroupware.org>
 * @package openid
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 *
 * Based on the following MIT Licensed packages:
 * @link https://github.com/steverhoades/oauth2-openid-connect-server
 * @link https://github.com/thephpleague/oauth2-server
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 */

namespace EGroupware\OpenID\Repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use EGroupware\OpenID\Entities\ScopeEntity;

class ScopeRepository implements ScopeRepositoryInterface
{
	protected static $scopes = [
		// Without this OpenID Connect cannot work.
		'openid' => [
			'description' => 'Enable OpenID Connect support'
		],
		'basic' => [
			'description' => 'Basic details about you',
		],
		'email' => [
			'description' => 'Your email address',
		],
	];

	/**
	 * Get available scopes
	 *
	 * @return array
	 */
	public static function getScopes()
	{
		return self::$scopes;
	}

    /**
     * {@inheritdoc}
     */
    public function getScopeEntityByIdentifier($scopeIdentifier)
    {
        if (array_key_exists($scopeIdentifier, self::$scopes) === false) {
            return;
        }

        $scope = new ScopeEntity();
        $scope->setIdentifier($scopeIdentifier);
		$scope->setDescription(self::$scopes[$scopeIdentifier]['description']);

        return $scope;
    }

    /**
     * {@inheritdoc}
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        // Example of programatically modifying the final scope of the access token
        if ((int) $userIdentifier === 1) {
            $scope = new ScopeEntity();
            $scope->setIdentifier('email');
			$scope->setDescription(self::$scopes[$scopeIdentifier]['description']);
            $scopes[] = $scope;
        }

        return $scopes;
    }
}