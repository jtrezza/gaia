<?php

class Post extends Eloquent
{
	protected $table = 'posts';
	protected $fillable = array('text','reposted','favorited','user_id','rt_id','reply_to');

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function rt_id()
    {
        return $this->belongsTo('Post','rt_id');
    }

    public function reply_to()
    {
        return $this->belongsTo('Post','reply_to');
    }
    public function getAgoAttribute()
    {
    	$datetime1 = date_create($this->created_at);
		$datetime2 = date_create(date('Y-m-d H:i:s'));
		$interval = date_diff($datetime1, $datetime2);
		
		if($interval->format('%y') != 0)
		{
			return $interval->format('%y años');
		}else if($interval->format('%m') != 0)
		{
			return $interval->format('%m meses');
		}else if($interval->format('%d') != 0)
		{
			return $interval->format('%d días');
		}else if($interval->format('%h') != 0)
		{
			return $interval->format('%h h');
		}else if($interval->format('%i') != 0)
		{
			return $interval->format('%i min');
		}else{
			return 'ahora';
		}
		
    }
    
    /*public function getTextAttribute()
    {
        $temp_text = $this->attributes['text'];
        
        return htmlentities($temp_text);
    }*/
    
    public function setTextAttribute($value)
    {
        $html = array("<", ">");
		$entities   = array("&lt;", "&gt;");
		
		$this->attributes['text'] = str_replace($html, $entities, $value);
    }
    public function getTextAttribute()
    {
        $temp_text = $this->attributes['text'];
        
        $ruta_perfil = url('/profile');
        
        $patron = "/\@([\w\d_]+)/i";
        $sustitucion = '<a target="_self" href="'.$ruta_perfil.'/${1}">${0}</a>';
        return preg_replace($patron, $sustitucion, $temp_text);
    }
    public function toArray()
    {
        $array = parent::toArray();
        $array['text_original'] = $this->textOriginal;
        return $array;
    }

    public function getTextOriginalAttribute()
    {
        return $this->attributes['text'];
    }
    /*public function getTextAttribute()
    {
        $temp_text = $this->attributes['text'];
        
        $patron = "/(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?/i";
        $sustitucion = '<a target="_blank" href="${0}">enlace</a>';
        return preg_replace($patron, $sustitucion, $temp_text);
    }*/
    
    public function scopeTimeline($query, User $user, $last = 0)
    {
    	$following = $user->followingArray;
    	$following[] = $user->id;
    	$GLOBALS['following'] = $following;
    	$GLOBALS['username'] = $user->username;
    	return $query->with('user')
    	    ->where(function($query){
    	        $query->whereIn('user_id', $GLOBALS['following'])
    	        ->orWhere('text', 'LIKE', '%@'.$GLOBALS['username'].'%');
    	    })
    	    ->where('id','>',$last)->orderBy('created_at', 'desc')->take(20)->get();
    }
    
    /*public function save()
    {
      parent::save();
      
        $temp_text = $this->attributes['text'];
        
        $patron = "/\@([\w\d_]+)/i";
        return preg_replace($patron, $sustitucion, $temp_text);
        
        preg_match($patron, $temp_text, $coincidencias);
        
        foreach($coincidencias as $i => $v){
            if($i != 0){
                $usuario = User::where('username',$coincidencias[1])->first();
                if($usuario){
                    
                }
            }
        }
        
        
    }*/
}