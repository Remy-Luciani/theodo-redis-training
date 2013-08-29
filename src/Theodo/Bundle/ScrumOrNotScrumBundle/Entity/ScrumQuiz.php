<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Entity;

class ScrumQuiz
{
    private $id;

    private $authorName;

    private $question;

    private $answer;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer()
    {
        return (bool) $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = (bool) $answer;

        return $this;
    }

    public function toArray()
    {
        $array = get_object_vars($this);

        return $array;
    }

    public function fromArray(array $array)
    {
         foreach($array as $key => $value)
         {
             $this->{$key} = $value;
         }

        return $this;
    }
}

