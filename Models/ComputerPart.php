<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class ComputerPart implements Model {
    use GenericModel;

    // php 8のコンストラクタのプロパティプロモーションは、インスタンス変数を自動的に設定します。
    public function __construct(
        private string $name,
        private string $type,
        private string $brand,
        private ?int $id = null,
        private ?string $modelNumber = null,
        private ?string $releaseDate = null,
        private ?string $description = null,
        private ?int $performanceScore = null,
        private ?float $marketPrice = null,
        private ?float $rsm = null,
        private ?float $powerConsumptionW = null,
        private ?float $lengthM = null,
        private ?float $widthM = null,
        private ?float $heightM = null,
        private ?int $lifespan = null,
        private ?DataTimeStamp $timeStamp = null,
    ) {}

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function getBrand(): string {
        return $this->brand;
    }

    public function setBrand(string $brand): void {
        $this->brand = $brand;
    }

    public function getModelNumber(): ?string {
        return $this->modelNumber;
    }

    public function setModelNumber(string $modelNumber): void {
        $this->modelNumber = $modelNumber;
    }

    public function getReleaseDate(): ?string {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): void {
        $this->releaseDate = $releaseDate;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getPerformanceScore(): ?int {
        return $this->performanceScore;
    }

    public function setPerformanceScore(int $performanceScore): void {
        $this->performanceScore = $performanceScore;
    }

    public function getMarketPrice(): ?float {
        return $this->marketPrice;
    }

    public function setMarketPrice(float $marketPrice): void {
        $this->marketPrice = $marketPrice;
    }

    public function getRsm(): ?float {
        return $this->rsm;
    }

    public function setRsm(float $rsm): void {
        $this->rsm = $rsm;
    }

    public function getPowerConsumptionW(): ?float {
        return $this->powerConsumptionW;
    }

    public function setPowerConsumptionW(float $powerConsumptionW): void {
        $this->powerConsumptionW = $powerConsumptionW;
    }

    public function getLengthM(): ?float {
        return $this->lengthM;
    }

    public function setLengthM(float $lengthM): void {
        $this->lengthM = $lengthM;
    }

    public function getWidthM(): ?float {
        return $this->widthM;
    }

    public function setWidthM(float $widthM): void {
        $this->widthM = $widthM;
    }

    public function getHeightM(): ?float {
        return $this->heightM;
    }

    public function setHeightM(float $heightM): void {
        $this->heightM = $heightM;
    }

    public function getLifespan(): ?int {
        return $this->lifespan;
    }

    public function setLifespan(int $lifespan): void {
        $this->lifespan = $lifespan;
    }

    public function getTimeStamp(): ?DataTimeStamp
    {
        return $this->timeStamp;
    }

    public function setTimeStamp(DataTimeStamp $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }
}