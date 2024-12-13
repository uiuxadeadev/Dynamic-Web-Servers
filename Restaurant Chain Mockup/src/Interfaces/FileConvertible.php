<?php
namespace Interfaces;

interface FileConvertible {
    /**
     * Convert the object to a string representation
     * @return string
     */
    public function toString(): string;

    /**
     * Convert the object to HTML representation
     * @return string
     */
    public function toHTML(): string;

    /**
     * Convert the object to Markdown representation
     * @return string
     */
    public function toMarkdown(): string;

    /**
     * Convert the object to array representation
     * @return array
     */
    public function toArray(): array;
}