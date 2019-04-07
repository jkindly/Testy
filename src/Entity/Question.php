<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $questionTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer4;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Test", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $test;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionTitle(): ?string
    {
        return $this->questionTitle;
    }

    public function setQuestionTitle(string $questionTitle): self
    {
        $this->questionTitle = $questionTitle;

        return $this;
    }

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(?string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(?string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(?string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getAnswer4(): ?string
    {
        return $this->answer4;
    }

    public function setAnswer4(?string $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }
}
