<?php

declare(strict_types=1);

namespace ConferenceApp;

class Agenda implements \Iterator, \Countable
{
    /**
     * @var Slot[]
     */
    private $slots;

    /**
     * @var int
     */
    private $position = 0;

    public function __construct()
    {
        $this->slots = [];
    }

    /**
     * @param Slot $slot
     * @return void
     */
    public function addSlot(Slot $slot): void
    {
        if (!$this->overlaps($slot)) {
            $this->slots[] = $slot;
        }

        $this->sortByDate();
    }

    /**
     * Sort slots by start date
     * @return void
     */
    private function sortByDate(): void
    {
        usort($this->slots, function ($a, $b) {
            
            return $a->getStartAt()->getTimestamp() - $b->getStartAt()->getTimestamp();
        });
    }

    /**
     * @param Slot $slot
     * @return bool
     */
    public function overlaps(Slot $slot): bool
    {
        foreach ($this->slots as $existingSlot) {
            if ($slot->overlaps($existingSlot)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        /**
         * @todo: Implement it
         */
        return count($this->slots);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        /**
         * @todo: Implement it
         */
        $this->position = 0;
    }

    /**
     * @return Slot|false
     */
    public function current()
    {
        /**
         * @todo: Implement it
         */
        return $this->slots[$this->position];
    }

    /**
     * @return int|null
     */
    public function key(): ?int
    {
        /**
         * @todo: Implement it
         */
        return $this->position;
    }

    /**
     * @return void
     */
    public function next(): void
    {
        /**
         * @todo: Implement it
         */
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        /**
         * @todo: Implement it
         */
        return isset($this->slots[$this->position]);
    }
}
