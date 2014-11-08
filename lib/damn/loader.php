<?php
/**
 * on function dispatch
 */
function get($path, $callback = null){
	on('GET', $path, $callback);
}

function post($path, $callback = null){
	on('POST', $path, $callback);
}

function put($path, $callback = null){
	on('PUT', $path, $callback);
}

function delete($path, $callback = null){
	on('DELETE', $path, $callback);
}

/**
 *
 * calling/executing controller or method in controller
 * controller name is *Controller.php , must be in app/controller
 * calling controller / method -> controller('nameController.nameAction', array(args1, args2))
 * where array is parameter in controller / method
 * 
 * @param  string $classAction class/method executing in app/controller
 * @param  [type] $params      parameter in class/method
 * @return if file exist, return instance,
 */
function controller($classAction, $params = null){
	$classAction = explode('.', $classAction);

	/**
	 * if type is class, without method
	 */
	if (sizeof($classAction) == 1) {
		$class = $classAction[0] . 'Controller';
		if (file_exists('app/controllers/'.$class.'.php')) {
			if ($params == null) {
				$instance = new $class();
				return $instance;
			}
			else{
				$reflector = new ReflectionClass($class);
				$instance = $reflector->newInstanceArgs($params);
				return $instance;
			}
		}
		else{
			if (PHASE == 'development') {
				set_exception_handler('exception_handler'); 
				throw new Exception("Controller '$class' not found");
			}
		}
	}
	else{
		$class = $classAction[0] . 'Controller';
		$action = $classAction[1];

		if (file_exists('app/controllers/'.$class.'.php')) {

			if ($params == null) {
				$instance = new $class();
				return $instance->$action();
			}
			else{
				$reflectionMethod = new ReflectionMethod($class, $action);
				echo $reflectionMethod->invokeArgs(new $class(), $params);
			}
		}
		else{
			if (PHASE == 'development') {
				set_exception_handler('exception_handler'); 
				throw new Exception("Controller '$class' not found");
			}
		}
	}
};


/**
 * call model, filename must be *Model.php, and classname must be *Model
 * -> model('modelName')
 *
 * if using data base, model must have public variable, "table_name"
 * and return it to data,
 * 
 * $data -> model('modelName')->data
 * with $data, so we can perform damn query builder
 * 
 * @param  string $nameModel 
 * @return if file exist, return instance,
 */
function model($nameModel){
	
	if (file_exists('app/models/'.$nameModel.'Model.php')) {

		$nameModel2 = $nameModel . 'Model';
		$instance = new $nameModel2();

		$instance->data = new DB($instance->table_name);

		return $instance;

	}
	else{
		if (PHASE == 'development') {
			set_exception_handler('exception_handler'); 
			throw new Exception("Model '$nameModel' not found");
		}
	}
}

/**
 * Custom exception handler
 * 
 * @param  [type] $e [description]
 * @return [type]    [description]
 */
function exception_handler($e) {
	echo "
<style>
	.dmnErr{
		padding : 100px;
		font-family : Helvetica, Arial, sans-serif;
		line-height : 1.8em;
		color: #333;
	}
	.damnMsg{
		font-size: 2em;
		line-height: 2.2em;
		font-weight : bold;

	}
</style>
	";
	echo '<div class="dmnErr">';
	echo '<div class="damnMsg">' . $e->getMessage(). "</div>";
	echo '<div class="damnFl">File : '. $e->getFile(). "</div>";
	echo '<div class="damnLn"> Line : ' . $e->getLine(). "</div>";
	echo '<pre class="damnTrc">';
	echo "<h2>Trace:</h2>" . $e->getTraceAsString(). "<br>"; 
	echo "</pre>";
	echo '</div>';
} 