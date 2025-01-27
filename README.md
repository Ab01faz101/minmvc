# miniMVC

A lightweight PHP framework designed for simple and efficient web development.

## Features

- **Routing**: Handle HTTP requests and map them to appropriate functions or controllers.
- **Validation**: Easy-to-use validation rules for form inputs.
- **Helper**: Includes various utility functions for common tasks.
- **Request**: Access to request data (GET, POST, etc.) with ease.
- **CRUD**: Simple methods for Create, Read, Update, and Delete operations.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Ab01faz101/minmvc.git
   ```
   ```bash
   cd minmvc
   ```

# Usage

## route service

```php
$router->addRoute('GET', '/', HomeController::class, 'index');
```
## request service
```php
$request = new Request();
$inputs = $request->post();
```
## validation service

```php
$request = new Request();
$inputs = $request->post();
$validator = new Validator();
$rules = [
    'title' => 'required',
];
$valid = $validator->validate($inputs, $rules);
if (!$valid){
    $result = ["status" => 0, "message" => "validation error"];
}
```

## CRUD Service


### create
```php
$todoModel = new Todo();
$todoModel->create($inputs);
```

### read
```php
$todoModel = new Todo();
// get all
$todoModel->getAll();
// find
$todoModel->find($id);
```


### update
```php
$todoModel = new Todo();
$todoModel->update($id , $inputs);
```

### delete
```php
$todoModel = new Todo();
$todoModel->delete($id);
```

## Conclusion

This is a small and experimental project created as a learning exercise. I'm excited to share it and would love to hear your feedback! If you have any suggestions, improvements, or if you can optimize it further, feel free to let me know.

Thank you for checking out **miniMVC**!
