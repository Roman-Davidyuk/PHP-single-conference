<?php

declare(strict_types=1);

namespace ConferenceApp;

abstract class Slot
{
    /**
     * @var Speaker
     */
    private $speaker;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $startAt;

    /**
     * @var \DateTime
     */
    private $endAt;

    /**
     * @param Speaker $speaker
     * @param string $title
     * @param string $description
     * @param \DateTime $startAt
     * @param \DateTime $endAt
     */
    public function __construct(Speaker $speaker, string $title, string $description, \DateTime $startAt, \DateTime $endAt)
    {
        if($startAt >= $endAt) {
            throw new \InvalidArgumentException();
        }

        $this->speaker = $speaker;
        $this->title = $title;
        $this->description = $description;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    /**
     * @param Slot $slot
     * @return bool
     */
    public function overlaps(Slot $slot): bool
    {
        $startAt = $slot->getStartAt()->getTimestamp();
        $endAt = $slot->getEndAt()->getTimestamp();

        return $this->startAt->getTimestamp() < $endAt && $startAt < $this->endAt->getTimestamp();
    }

    /**
     * @return \DateTime
     */
    public function getStartAt(): \DateTime
    {
        return $this->startAt;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt(): \DateTime
    {
        return $this->endAt;
    }

    /**
     * @return \DateTime
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
