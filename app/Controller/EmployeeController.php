<?php
namespace Controller;

use Model\Department;
use Model\Employee;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class EmployeeController
{
    public function index(): string
    {
        $employees = Employee::with('department')->get();
        return new View('employee.index', ['employees' => $employees]);
    }

    public function create(): string
    {
        $departments = Department::all();
        return new View('employee.create', ['departments' => $departments]);
    }

    // Сохранение нового сотрудника
    public function store(Request $request): string
    {
        $validator = new Validator($request->all(), [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'birth_date' => ['required'],
            'address' => ['required'],
            'position' => ['required']
        ], [
            'required' => 'Поле :field обязательно для заполнения'
        ]);

        if ($validator->fails()) {
            return new View('employee.create', [
                'departments' => Department::all(),
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
            ]);
        }

        if (Employee::create($request->all())) {
            app()->route->redirect('/employees');
            return '';
        }

        return new View('employee.create', [
            'departments' => Department::all(),
            'message' => 'Ошибка создания сотрудника'
        ]);
    }

    public function edit(Request $request): string
    {
        $employee = Employee::find($request->get('id'));
        if (!$employee) {
            app()->route->redirect('/employees');
            return '';
        }
        $departments = Department::all();
        return new View('employee.edit', ['employee' => $employee, 'departments' => $departments]);
    }

    public function update(Request $request): string
    {
        $employee = Employee::find($request->get('id'));
        if (!$employee) {
            app()->route->redirect('/employees');
            return '';
        }

        $employee->update($request->all());
        app()->route->redirect('/employees');
        return '';
    }

    public function destroy(Request $request): string
    {
        $employee = Employee::find($request->get('id'));
        if ($employee) {
            $employee->delete();
        }
        app()->route->redirect('/employees');
        return '';
    }
}