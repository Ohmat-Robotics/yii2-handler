<?php

use common\helpers\Handler;

Handler::addText("Some text");
Handler::addText(["Some text 1","Some text 2"]);
Handler::addText(["Some text 1","Some text 2"], true);

Handler::addMessage("Some message");
Handler::addMessage(["Some message 1","Some message 2"]);
Handler::addMessage(["Some message 1","Some message 2"], true);

Handler::addError("Some error");
Handler::addError(["Some error 1","Some error 2"]);
Handler::addError(["Some error 1","Some error 2"], true);

try{
	echo $some_warning_or_fatal;
}catch(Exception $exception){
	Handler::addException($exception);
}

?>
