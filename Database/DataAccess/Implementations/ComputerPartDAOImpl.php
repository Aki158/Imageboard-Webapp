<?php

namespace Database\DataAccess\Implementations;

// use Database\DataAccess\Interfaces\ComputerPartDAO;
use Database\DataAccess\InterfacesComputerPart\ComputerPartDAO;
use Database\DatabaseManager;
use Models\ComputerPart;
use Models\DataTimeStamp;

class ComputerPartDAOImpl implements ComputerPartDAO
{
    public function create(ComputerPart $partData): bool
    {
        if($partData->getId() !== null) throw new \Exception('Cannot create a computer part with an existing ID. id: ' . $partData->getId());
        return $this->createOrUpdate($partData);
    }

    public function getById(int $id): ?ComputerPart
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        $computerPart = $mysqli->prepareAndFetchAll("SELECT * FROM computer_parts WHERE id = ?",'i',[$id])[0]??null;

        return $computerPart === null ? null : $this->resultToComputerPart($computerPart);
    }

    public function update(ComputerPart $partData): bool
    {
        if($partData->getId() === null) throw new \Exception('Computer part specified has no ID.');

        $current = $this->getById($partData->getId());
        if($current === null) throw new \Exception(sprintf("Computer part %s does not exist.", $partData->getId()));

        return $this->createOrUpdate($partData);
    }

    public function delete(int $id): bool
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        return $mysqli->prepareAndExecute("DELETE FROM computer_parts WHERE id = ?", 'i', [$id]);
    }

    public function getRandom(): ?ComputerPart
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        $computerPart = $mysqli->prepareAndFetchAll("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1",'',[])[0]??null;

        return $computerPart === null ? null : $this->resultToComputerPart($computerPart);
    }

    public function getAll(int $offset, int $limit): array
    {
        $mysqli = DatabaseManager::getMysqliConnection();

        $query = "SELECT * FROM computer_parts LIMIT ?, ?";

        $results = $mysqli->prepareAndFetchAll($query, 'ii', [$offset, $limit]);

        return $results === null ? [] : $this->resultsToComputerParts($results);
    }

    public function getAllByType(string $type, int $offset, int $limit): array
    {
        $mysqli = DatabaseManager::getMysqliConnection();

        $query = "SELECT * FROM computer_parts WHERE type = ? LIMIT ?, ?";

        $results = $mysqli->prepareAndFetchAll($query, 'sii', [$type, $offset, $limit]);
        return $results === null ? [] : $this->resultsToComputerParts($results);
    }

    public function createOrUpdate(ComputerPart $partData): bool
    {
        $mysqli = DatabaseManager::getMysqliConnection();

        $query =
        <<<SQL
            INSERT INTO computer_parts (id, name, type, brand, model_number, release_date, description, performance_score, market_price, rsm, power_consumptionw, lengthm, widthm, heightm, lifespan)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE id = ?,
            name = VALUES(name),
            type = VALUES(type),
            brand = VALUES(brand),
            model_number = VALUES(model_number),
            release_date = VALUES(release_date),
            description = VALUES(description),
            performance_score = VALUES(performance_score),
            market_price = VALUES(market_price),
            rsm = VALUES(rsm),
            power_consumptionw = VALUES(power_consumptionw),
            lengthm = VALUES(lengthm),
            widthm = VALUES(widthm),
            heightm = VALUES(heightm),
            lifespan = VALUES(lifespan);
        SQL;

        $result = $mysqli->prepareAndExecute(
            $query,
            'issssssidddddddi',
            [
                $partData->getId(), // on null ID, mysql will use auto-increment.
                $partData->getName(),
                $partData->getType(),
                $partData->getBrand(),
                $partData->getModelNumber(),
                $partData->getReleaseDate(),
                $partData->getDescription(),
                $partData->getPerformanceScore(),
                $partData->getMarketPrice(),
                $partData->getRsm(),
                $partData->getPowerConsumptionW(),
                $partData->getLengthM(),
                $partData->getWidthM(),
                $partData->getHeightM(),
                $partData->getLifespan(),
                $partData->getId()
            ],
        );

        if(!$result) return false;

        // insert_id returns the last inserted ID.
        if($partData->getId() === null){
            $partData->setId($mysqli->insert_id);
            $timeStamp = $partData->getTimeStamp()??new DataTimeStamp(date('Y-m-h'), date('Y-m-h'));
            $partData->setTimeStamp($timeStamp);
        }

        return true;
    }

    private function resultToComputerPart(array $data): ComputerPart{
        return new ComputerPart(
            name: $data['name'],
            type: $data['type'],
            brand: $data['brand'],
            id: $data['id'],
            modelNumber: $data['model_number'],
            releaseDate: $data['release_date'],
            description: $data['description'],
            performanceScore: $data['performance_score'],
            marketPrice: $data['market_price'],
            rsm: $data['rsm'],
            powerConsumptionW: $data['power_consumptionw'],
            lengthM: $data['lengthm'],
            widthM: $data['widthm'],
            heightM: $data['heightm'],
            lifespan: $data['lifespan'],
            timeStamp: new DataTimeStamp($data['created_at'], $data['updated_at'])
        );
    }

    private function resultsToComputerParts(array $results): array{
        $computerParts = [];

        foreach($results as $result){
            $computerParts[] = $this->resultToComputerPart($result);
        }

        return $computerParts;
    }
}