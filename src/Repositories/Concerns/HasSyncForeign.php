<?php

namespace Genesis\Repositories\Concerns;

use Carbon\Carbon;

trait HasSyncForeign
{
    /**
     * The created at column.
     *
     * @var string
     */
    protected $createdAt = 'created_at';

    /**
     * The updated at column.
     *
     * @var string
     */
    protected $updatedAt = 'updated_at';

    /**
     * The foreign model.
     *
     * @var string
     */
    protected $foreignModel;

    /**
     * The foreign key.
     *
     * @var string
     */
    protected $foreignKey;

    /**
     * Sync main table data to foreign table.
     *
     * @param int $id
     * @param  array attachIds
     *
     * @return int
     */
    public function sync(int $id, array $attributes): int
    {
        if (empty($attributes)) {
            return 0;
        }

        $this->foreignModel->where($this->foreignKey, $id)->delete();

        return $this->foreignModel->insert($this->formatData($id, $attributes));
    }

    /**
     * Append main table data to foreign table.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return int
     */
    public function append(int $id, array $attributes): int
    {
        if (empty($attributes)) {
            return 0;
        }

        return $this->foreignModel->insert(
            $this->formatData($id, $attributes)
        );
    }

    /**
     * Format data.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return array
     */
    protected function formatData(int $id, array $attributes): array
    {
        $formatted = [];
        $today = Carbon::now();
        if ($this->isArray2D($attributes)) {
            foreach ($attributes as $data) {
                $formatted[] = array_merge($data, [
                    $this->foreignKey => $id,
                    $this->createdAt => $today,
                    $this->updatedAt => $today,
                ]);
            }
        } else {
            $formatted = array_merge($attributes, [
                $this->foreignKey => $id,
                $this->createdAt => $today,
                $this->updatedAt => $today,
            ]);
        }

        return $formatted;
    }

    /**
     * Check if array is 2D.
     *
     * @param array $data
     *
     * @return bool
     */
    protected function isArray2D(array $data): bool
    {
        return is_array($data[0]);
    }
}
