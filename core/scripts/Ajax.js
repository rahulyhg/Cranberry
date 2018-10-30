function Ajax(script, action, additionalPost, onFinish){
	var req = new XMLHttpRequest();
	req.open('POST', 'core/ajax/' + script + '.php', true);
	req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	req.onreadystatechange = function(){
		if(req.readyState == 4 && req.status == 200){
			onFinish(req.responseText);
		}
	};

	req.send('action=' + action + '&' + additionalPost);
}