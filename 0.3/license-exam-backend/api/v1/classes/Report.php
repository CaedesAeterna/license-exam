<?php

class Report
{
    private int $id;
    private string $summary;
    private string $comments;
    private string $start;
    private float $hours;
    private string $start_date;
    private string $start_hour;
    private string $duration;
    private int $tasks_id;
    private int $projects_id;


    public function __construct(
        int $id,
        string $summary,
        string $comments,
        string $start,
        float $hours,
        string $start_date,
        string $start_hour,
        string $duration,
        int $tasks_id,
        int $projects_id
    ) {
        $this->id = $id;
        $this->summary = $summary;
        $this->comments = $comments;
        $this->start = $start;
        $this->hours = $hours;
        $this->start_date = $start_date;
        $this->start_hour = $start_hour;
        $this->duration = $duration;
        $this->tasks_id = $tasks_id;
        $this->projects_id = $projects_id;
    }
    //todo

}

