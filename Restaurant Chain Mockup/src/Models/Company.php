<?php
namespace Models;

use Interfaces\FileConvertible;

class Company implements FileConvertible {
    protected string $name;
    protected int $foundingYear;
    protected string $description;
    protected string $website;
    protected string $phone;
    protected string $industry;
    protected string $ceo;
    protected bool $isPubliclyTraded;

    public function __construct(
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
    }

    public function toString(): string {
        return sprintf(
            "Company: %s\nFounded: %d\nDescription: %s\nWebsite: %s\nPhone: %s\nIndustry: %s\nCEO: %s\nPublicly Traded: %s",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string {
        return sprintf(
            '<div class="company-info">
                <h2>%s</h2>
                <p><strong>Founded:</strong> %d</p>
                <p><strong>Description:</strong> %s</p>
                <p><strong>Website:</strong> <a href="%s">%s</a></p>
                <p><strong>Phone:</strong> %s</p>
                <p><strong>Industry:</strong> %s</p>
                <p><strong>CEO:</strong> %s</p>
                <p><strong>Publicly Traded:</strong> %s</p>
            </div>',
            htmlspecialchars($this->name),
            $this->foundingYear,
            htmlspecialchars($this->description),
            htmlspecialchars($this->website),
            htmlspecialchars($this->website),
            htmlspecialchars($this->phone),
            htmlspecialchars($this->industry),
            htmlspecialchars($this->ceo),
            $this->isPubliclyTraded ? 'Yes' : 'No'
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "# %s\n\n" .
            "- **Founded:** %d\n" .
            "- **Description:** %s\n" .
            "- **Website:** [%s](%s)\n" .
            "- **Phone:** %s\n" .
            "- **Industry:** %s\n" .
            "- **CEO:** %s\n" .
            "- **Publicly Traded:** %s\n",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No'
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded
        ];
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getFoundingYear(): int {
        return $this->foundingYear;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getWebsite(): string {
        return $this->website;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getIndustry(): string {
        return $this->industry;
    }

    public function getCeo(): string {
        return $this->ceo;
    }

    public function isPubliclyTraded(): bool {
        return $this->isPubliclyTraded;
    }
}