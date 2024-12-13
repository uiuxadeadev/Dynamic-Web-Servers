<?php
namespace Models;

use DateTime;
use Interfaces\FileConvertible;

class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        DateTime $membershipExpirationDate,
        string $role,
        string $jobTitle,
        float $salary,
        DateTime $startDate,
        array $awards = []
    ) {
        parent::__construct(
            $id, $firstName, $lastName, $email, $password,
            $phoneNumber, $address, $birthDate, $membershipExpirationDate, $role
        );
        
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function toString(): string {
        $parentString = parent::toString();
        return $parentString . sprintf(
            "\nJob Title: %s\nSalary: $%.2f\nStart Date: %s\nAwards: %s",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toHTML(): string {
        $awardsHtml = count($this->awards) > 0
            ? '<ul class="awards">' . implode('', array_map(fn($award) => "<li>$award</li>", $this->awards)) . '</ul>'
            : '<p>No awards yet</p>';

        return sprintf(
            '<div class="employee-card">
                <div class="employee-header">
                    <h3>%s %s</h3>
                    <span class="job-title">%s</span>
                </div>
                <div class="employee-details">
                    <p><strong>Email:</strong> %s</p>
                    <p><strong>Phone:</strong> %s</p>
                    <p><strong>Start Date:</strong> %s</p>
                    <p><strong>Salary:</strong> $%.2f</p>
                    <div class="awards-section">
                        <h4>Awards</h4>
                        %s
                    </div>
                </div>
            </div>',
            htmlspecialchars($this->firstName),
            htmlspecialchars($this->lastName),
            htmlspecialchars($this->jobTitle),
            htmlspecialchars($this->email),
            htmlspecialchars($this->phoneNumber),
            $this->startDate->format('Y-m-d'),
            $this->salary,
            $awardsHtml
        );
    }

    public function toMarkdown(): string {
        $awardsText = count($this->awards) > 0
            ? "- " . implode("\n- ", $this->awards)
            : "No awards yet";

        return sprintf(
            "#### %s %s\n" .
            "- **Job Title:** %s\n" .
            "- **Email:** %s\n" .
            "- **Phone:** %s\n" .
            "- **Start Date:** %s\n" .
            "- **Salary:** $%.2f\n\n" .
            "**Awards:**\n%s\n",
            $this->firstName,
            $this->lastName,
            $this->jobTitle,
            $this->email,
            $this->phoneNumber,
            $this->startDate->format('Y-m-d'),
            $this->salary,
            $awardsText
        );
    }

    public function toArray(): array {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate->format('Y-m-d'),
            'awards' => $this->awards
        ]);
    }

    // Getters
    public function getJobTitle(): string {
        return $this->jobTitle;
    }

    public function getSalary(): float {
        return $this->salary;
    }

    public function getStartDate(): DateTime {
        return $this->startDate;
    }

    public function getAwards(): array {
        return $this->awards;
    }

    public function addAward(string $award): void {
        $this->awards[] = $award;
    }   
}