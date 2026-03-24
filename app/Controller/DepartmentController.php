<?php
namespace Controller;

use Model\Department;
use Src\Request;
use Src\View;

class DepartmentController
{
    public function index(): string
    {
        $departments = Department::all();
        return new View('department.index', ['departments' => $departments]);
    }

    public function create(): string
    {
        return new View('department.create');
    }

    public function store(Request $request): string
    {
        $validator = new Validator($request->all(), [
            'name' => ['required'],
            'type' => ['required']
        ], [
            'required' => 'Поле :field обязательно для заполнения'
        ]);

        if ($validator->fails()) {
            return new View('department.create', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
        }

        if (Department::create($request->all())) {
            app()->route->redirect('/departments');
        }

        return new View('department.create', ['message' => 'Ошибка создания подразделения']);
    }

    public function destroy(Request $request): void
    {
        $department = Department::find($request->get('id'));
        if ($department) {
            $department->delete();
        }
        app()->route->redirect('/departments');
    }
}