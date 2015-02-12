<?php
   

public function selectRandomMovie()
{
	return SELECT * FROM `Movie` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `Movie` ) ORDER BY id LIMIT 1;
}