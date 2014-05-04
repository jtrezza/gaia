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
}