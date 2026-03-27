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

    public function transferForm(Request $request): string
    {
        $employee = Employee::find($request->get('id'));
        if (!$employee) {
            app()->route->redirect('/employees');
            return '';
        }

        $departments = Department::all();
        return (new View('employee.transfer', [
            'employee' => $employee,
            'departments' => $departments
        ]))->render();
    }

    public function transfer(Request $request): string
    {
        $employee = Employee::find($request->get('id'));
        if (!$employee) {
            app()->route->redirect('/employees');
            return '';
        }

        $validator = new Validator($request->all(), [
            'department_id' => ['required']
        ], [
            'required' => 'Выберите подразделение'
        ]);

        if ($validator->fails()) {
            return (new View('employee.transfer', [
                'employee' => $employee,
                'departments' => Department::all(),
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
            ]))->render();
        }

        $employee->department_id = $request->get('department_id');
        $employee->save();

        app()->route->redirect('/employees');
        return '';
    }
    public function averageAge(): string
    {
        $employees = Employee::all();

        $totalAge = 0;
        $count = 0;

        foreach ($employees as $employee) {
            if ($employee->birth_date) {
                $birthDate = new \DateTime($employee->birth_date);
                $today = new \DateTime();
                $age = $today->diff($birthDate)->y;
                $totalAge += $age;
                $count++;
            }
        }

        $averageAge = $count > 0 ? round($totalAge / $count, 1) : 0;

        // Средний возраст по подразделениям
        $departments = Department::all();
        $ageByDepartment = [];

        foreach ($departments as $department) {
            $deptTotal = 0;
            $deptCount = 0;
            foreach ($department->employees as $employee) {
                if ($employee->birth_date) {
                    $birthDate = new \DateTime($employee->birth_date);
                    $today = new \DateTime();
                    $age = $today->diff($birthDate)->y;
                    $deptTotal += $age;
                    $deptCount++;
                }
            }
            $ageByDepartment[$department->id] = [
                'name' => $department->name,
                'average' => $deptCount > 0 ? round($deptTotal / $deptCount, 1) : 0,
                'count' => $deptCount
            ];
        }

        return (new View('employee.average', [
            'averageAge' => $averageAge,
            'ageByDepartment' => $ageByDepartment,
            'totalEmployees' => $count
        ]))->render();
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
