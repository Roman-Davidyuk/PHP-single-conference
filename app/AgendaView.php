<?php

declare(strict_types=1);

namespace ConferenceApp;

class AgendaView
{
    /**
     * @var Agenda
     */
    private $agenda;

    /**
     * @param Agenda $agenda
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * @return int
     */
    public function getNumberOfSlots(): int
    {
        /**
         * @todo: Implement it
         */
        return $this->agenda->count();
    }

    /**
     * return int
     */
    public function getDurationInMinutes(): float
    {
        $duration = 0;
        $previousEndAt = null;
        
        foreach ($this->agenda as $slot) {
            $startAt = $slot->getStartAt()->getTimestamp();
            $endAt = $slot->getEndAt()->getTimestamp();
            
            if ($previousEndAt) {
                $duration += max(0, $startAt - $previousEndAt->getTimestamp());
            }
            
            $duration += $endAt - $startAt;
            $previousEndAt = $slot->getEndAt();
        }
        
        return $duration / 60;
    }
}
