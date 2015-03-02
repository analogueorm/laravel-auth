<?php namespace Analogue\LaravelAuth;

use Analogue\ORM\System\Manager;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;


class AnalogueUserProvider implements UserProvider {

	/**
	* @var \Illuminate\Contracts\Hashing\Hasher
	*/
	protected $hasher;

	/**
	* @var string
	*/
	protected $entity;

	/**
	 * @param \Illuminate\Contracts\Hashing\HasherContract $hasher  
	 * @param \Analogue\ORM\System\Manager         $manager 
	 * @param string          $entity  
	 */
	public function __construct(HasherContract $hasher, $entity)
	{
		$this->hasher = $hasher;
		$this->entity = $entity;
	}

	/**
     * Retrieve a user by their unique identifier.
	 *
     * @param  mixed $identifier
     * @return UserInterface|null
     */
    public function retrieveById($identifier)
    {
        return $this->getRepository()->find($identifier);
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
	 *
     * @param  mixed $identifier
     * @param  string $token
     * @return UserInterface|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $entity = $this->getEntity();

        $keyName = Manager::mapper($entity)->getEntityMap()->getKeyName();

        return $this->getRepository()->where($keyName,'=',$identifier)
        	->where($entity->getRememberTokenName(), '=', $token)->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
	 *
     * @param  UserInterface $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        $user->setRememberToken($token);
        
        $this->getRepository()->store($user);
    }

    /**
     * Retrieve a user by the given credentials.
	 *
     * @param  array $credentials
     * @return UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $criteria = [];
        foreach ($credentials as $key => $value)
            if ( ! str_contains($key, 'password'))
                $criteria[$key] = $value;

        return $this->getRepository()->firstByAttributes($criteria);
    }

    /**
     * Validate a user against the given credentials.
	 *
     * @param  UserInterface $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $this->hasher->check($credentials['password'], $user->getAuthPassword());
    }

	/**
	* Returns repository for the entity.
	*
	* @return \Analogue\ORM\Repository
	*/
	private function getRepository()
	{
		return Manager::repository($this->entity);
	}

	/**
	 * Instantiate an user entity
	 * 
	 * @return \Analogue\ORM\Entity
	 */
	private function getEntity()
	{
        $entity = $this->getEntity();

		return Manager::mapper($entity)->newInstance();
	}
}