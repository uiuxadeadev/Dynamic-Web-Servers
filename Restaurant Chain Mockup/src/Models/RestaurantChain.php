<?php
namespace Models;

use Interfaces\FileConvertible;

class RestaurantChain extends Company implements FileConvertible {
    private int $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private bool $hasDriveThru;
    private string $parentCompany;

    public function __construct(
        int $chainId,
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $cuisineType,
        bool $hasDriveThru,
        string $parentCompany = ''
    ) {
        parent::__construct(
            $name,
            $foundingYear,
            $description,
            $website,
            $phone,
            $industry,
            $ceo,
            $isPubliclyTraded
        );
        
        $this->chainId = $chainId;
        $this->restaurantLocations = [];
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = 0;
        $this->hasDriveThru = $hasDriveThru;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string {
        $parentString = parent::toString();
        return $parentString . sprintf(
            "\nChain ID: %d\nCuisine Type: %s\nNumber of Locations: %d\nDrive Thru: %s\nParent Company: %s",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->parentCompany ?: 'Independent'
        );
    }

    public function toHTML(): string {
        $locationsList = '';
        foreach ($this->restaurantLocations as $location) {
            $locationsList .= $location->toHTML();
        }

        return sprintf(
            '<div class="restaurant-chain">
                <div class="chain-header">
                    <h1>%s</h1>
                    <div class="chain-meta">
                        <span class="cuisine-type">%s Cuisine</span>
                        <span class="location-count">%d Locations</span>
                    </div>
                </div>
                %s
                <div class="chain-details">
                    <h2>Chain Information</h2>
                    <p><strong>Chain ID:</strong> %d</p>
                    <p><strong>Founded:</strong> %d</p>
                    <p><strong>Description:</strong> %s</p>
                    <p><strong>Website:</strong> <a href="%s">%s</a></p>
                    <p><strong>Phone:</strong> %s</p>
                    <p><strong>Drive Thru:</strong> %s</p>
                    <p><strong>Parent Company:</strong> %s</p>
                </div>
                <div class="locations">
                    <h2>Locations</h2>
                    %s
                </div>
            </div>',
            htmlspecialchars($this->name),
            htmlspecialchars($this->cuisineType),
            $this->numberOfLocations,
            parent::toHTML(),
            $this->chainId,
            $this->foundingYear,
            htmlspecialchars($this->description),
            htmlspecialchars($this->website),
            htmlspecialchars($this->website),
            htmlspecialchars($this->phone),
            $this->hasDriveThru ? 'Available' : 'Not Available',
            $this->parentCompany ?: 'Independent',
            $locationsList
        );
    }

    public function toMarkdown(): string {
        $locationsList = '';
        foreach ($this->restaurantLocations as $location) {
            $locationsList .= $location->toMarkdown() . "\n\n";
        }

        return sprintf(
            "# %s\n\n" .
            "## Chain Information\n\n" .
            "- **Chain ID:** %d\n" .
            "- **Cuisine Type:** %s\n" .
            "- **Number of Locations:** %d\n" .
            "- **Drive Thru:** %s\n" .
            "- **Parent Company:** %s\n\n" .
            "%s\n\n" .
            "## Locations\n\n%s",
            $this->name,
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Available' : 'Not Available',
            $this->parentCompany ?: 'Independent',
            parent::toMarkdown(),
            $locationsList
        );
    }

    public function toArray(): array {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'chainId' => $this->chainId,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'hasDriveThru' => $this->hasDriveThru,
            'parentCompany' => $this->parentCompany,
            'locations' => array_map(fn($location) => $location->toArray(), $this->restaurantLocations)
        ]);
    }

    public function getChainId(): int {
        return $this->chainId;
    }

    public function getCuisineType(): string {
        return $this->cuisineType;
    }

    public function getNumberOfLocations(): int {
        return $this->numberOfLocations;
    }

    public function hasDriveThru(): bool {
        return $this->hasDriveThru;
    }

    public function getParentCompany(): string {
        return $this->parentCompany;
    }
    
    public function addLocation(RestaurantLocation $location): void {
        $this->restaurantLocations[] = $location;
        $this->numberOfLocations = count($this->restaurantLocations);
    }

    public function getLocations(): array {
        return $this->restaurantLocations;
    }


}
