<?php
namespace Models;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;

    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees = [],
        bool $isOpen = true
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
    }

    public function toString(): string {
        return sprintf(
            "Location: %s\nAddress: %s\nCity: %s\nState: %s\nZIP: %s\nStatus: %s\nEmployees: %d",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? 'Open' : 'Closed',
            count($this->employees)
        );
    }

    public function toHTML(): string {
        $employeesList = '';
        foreach ($this->employees as $employee) {
            $employeesList .= $employee->toHTML();
        }

        return sprintf(
            '<div class="restaurant-location">
                <h3>%s</h3>
                <div class="location-details">
                    <p><strong>Address:</strong> %s</p>
                    <p><strong>City:</strong> %s</p>
                    <p><strong>State:</strong> %s</p>
                    <p><strong>ZIP:</strong> %s</p>
                    <p><strong>Status:</strong> <span class="%s">%s</span></p>
                </div>
                <div class="employees">
                    <h4>Employees (%d)</h4>
                    %s
                </div>
            </div>',
            htmlspecialchars($this->name),
            htmlspecialchars($this->address),
            htmlspecialchars($this->city),
            htmlspecialchars($this->state),
            htmlspecialchars($this->zipCode),
            $this->isOpen ? 'open' : 'closed',
            $this->isOpen ? 'Open' : 'Closed',
            count($this->employees),
            $employeesList
        );
    }

    public function toMarkdown(): string {
        $employeesList = '';
        foreach ($this->employees as $employee) {
            $employeesList .= "  " . str_replace("\n", "\n  ", $employee->toMarkdown()) . "\n";
        }

        return sprintf(
            "### %s\n\n" .
            "- **Address:** %s\n" .
            "- **City:** %s\n" .
            "- **State:** %s\n" .
            "- **ZIP:** %s\n" .
            "- **Status:** %s\n\n" .
            "#### Employees (%d)\n\n%s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? 'Open' : 'Closed',
            count($this->employees),
            $employeesList
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'isOpen' => $this->isOpen,
            'employees' => array_map(fn($employee) => $employee->toArray(), $this->employees)
        ];
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getZipCode(): string {
        return $this->zipCode;
    }

    public function getEmployees(): array {
        return $this->employees;
    }
    
    public function addEmployee(Employee $employee): void {
        $this->employees[] = $employee;
    }

    public function isOpen(): bool {
        return $this->isOpen;
    }
}