<?php

namespace App\Entity;

//Not ORM just a Data Model
class Post
{
    private ?int $id = null;

    private ?string $title = null;

    private ?string $body = null;

    private ?string $mined_text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getMinedText(): ?string
    {
        return $this->mined_text;
    }

    public function setMinedText(?string $mined_text): self
    {
        $this->mined_text = $mined_text;

        return $this;
    }


    public function toArray():array
    {
        return [
            'id'=>$this->getId(),
            'title'=>$this->getTitle(),
            'body'=>$this->getBody(),
        ];
    }
}
