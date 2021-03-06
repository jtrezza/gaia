<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public $errors;
	protected $fillable = array('username','email','fullname','bio','location',
	    'website','password','profile_picture','following','followed','favorites');

	public function isValid($data)
    {
        $rules = array(
        	'username'		=> 'required|max:50|regex:/^([\w\d_]+)$/i|unique:users',
            'email'     => 'required|email|max:120|unique:users',
            'fullname' 	=> 'required|min:4|max:255',
            'password'  => 'min:6|confirmed',
            'bio'		=> 'max:160',
            'location'	=> 'max:120',
            'website'	=> 'max:120',
        );
        
        // Si el usuario existe:
        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
			$rules['email'] .= ',email,' . $this->id;
        }
        // Si el usuario existe:
        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
			$rules['username'] .= ',user,' . $this->id;
        }
        else // Si no existe...
        {
            // La clave es obligatoria:
            $rules['password'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function posts(){
		return $this -> has_many('Post');
	}

	public function isFollowing(User $user)
	{
		if(in_array($user->id, $this->followingArray)) {
			return true;
		}else{
			return false;
		}
	}

	public function isFollowingByUsername($username)
	{
		$usuario = User::where('username','=',$username)->first();
		if(!$usuario){
			return false;
		}else{
			return $this->isFollowing($usuario);
		}
	}

	public function isFollowingById($id)
	{
		$usuario = User::where('id','=',$id)->first();
		if(!$usuario){
			return false;
		}else{
			return $this->isFollowing($usuario);
		}
	}

    public function getFollowedArrayAttribute()
	{
		$followed = array();
		if($this->followed != '' && !is_null($this->followed))
		{
			$followed = unserialize($this->followed);
		}
		return $followed;
	}
	
	public function getFollowingArrayAttribute()
	{
		$following = array();
		if($this->following != '' && !is_null($this->following))
		{
			$following = unserialize($this->following);
		}
		return $following;
	}
	
	public function follow($username)
	{
	    $user = User::where('username',$username)->first();
	    if(!$user){
	        return false;
	    }
	    $following = $this->followingArray;
	    $following[] = $user->id;
	    
	    $this->following = serialize($following);
	    $this->save();
	}
	
	public function be_followed(User $user)
	{
	    //$user = User::where('username',$username)->first();
	    if(!$user){
	        return false;
	    }
	    $followed = $this->followedArray;
	    $followed[] = $user->id;
	    
	    $this->followed = serialize($followed);
	    $this->save();
	}
	
	public function unfollow($username)
	{
	    $user = User::where('username',$username)->first();
	    $following = $this->followingArray;
	    
	    if(array_search($user->id, $following) !== false){
	        $pos = array_search($user->id, $following);
	        array_splice($following, $pos, 1);
	        $this->following = serialize($following);
	        $this->save();
	    }
	}
	
	public function be_unfollowed(User $user)
	{
	    //$user = User::where('username',$username)->first();
	    if(!$user){
	        return false;
	    }
	    $followed = $this->followedArray;
	    
	    if(array_search($user->id, $followed) !== false){
	        $pos = array_search($user->id, $followed);
	        array_splice($followed, $pos, 1);
	        $this->followed = serialize($followed);
	        $this->save();
	    }
	}
}