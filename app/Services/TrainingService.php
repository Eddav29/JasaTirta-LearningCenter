<?php

namespace App\Services;

use App\Data\Training\CreateTrainingData;
use App\Data\Training\UpdateTrainingData;
use App\Models\Training;
use App\Repositories\Contracts\TrainingRepositoryInterface;
use App\Services\Contracts\TrainingServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TrainingService implements TrainingServiceInterface
{
    public function __construct(
        protected TrainingRepositoryInterface $repository
    ) {}

    public function getPaginatedTrainings(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->getAllWithFilters($filters, $perPage);
    }

    public function getTrainingById(int $id): ?Training
    {
        return $this->repository->findWithRelations($id);
    }

    public function createTraining(CreateTrainingData $data): Training
    {
        $trainingData = $data->toArray();

        // Handle image upload
        if ($data->image instanceof UploadedFile) {
            $trainingData['image'] = $this->uploadImage($data->image);
        }

        return $this->repository->create($trainingData);
    }

    public function updateTraining(Training $training, UpdateTrainingData $data): Training
    {
        $trainingData = $data->toArray();

        // Handle remove existing image
        if ($data->removeImage) {
            $this->deleteImage($training->image);
            $trainingData['image'] = null;
        }

        // Handle new image upload
        if ($data->image instanceof UploadedFile) {
            // Delete old image if exists
            if ($training->image) {
                $this->deleteImage($training->image);
            }

            $trainingData['image'] = $this->uploadImage($data->image);
        }

        return $this->repository->update($training, $trainingData);
    }

    public function deleteTraining(Training $training): bool
    {
        // Delete image if exists
        if ($training->image) {
            $this->deleteImage($training->image);
        }

        return $this->repository->delete($training);
    }

    public function bulkDeleteTrainings(array $ids): int
    {
        return $this->repository->bulkDelete($ids);
    }

    public function bulkUpdateStatus(array $ids, bool $isActive): int
    {
        return $this->repository->bulkUpdateStatus($ids, $isActive);
    }

    public function getStatistics(): array
    {
        return $this->repository->getStatistics();
    }

    public function getCategories(): Collection
    {
        return $this->repository->getAllCategories();
    }

    public function getInstructors(): Collection
    {
        return $this->repository->getAllInstructors();
    }

    /**
     * Upload training image.
     */
    protected function uploadImage(UploadedFile $image): string
    {
        $imageName = time().'_'.$image->getClientOriginalName();

        return $image->storeAs('trainings', $imageName, 'public');
    }

    /**
     * Delete training image.
     */
    protected function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
