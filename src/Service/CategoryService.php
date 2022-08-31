<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use DateTimeImmutable;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class CategoryService.
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * Category repository.
     */
    private CategoryRepository $categoryRepository;

    /**
     * Event repository.
     */
    private EventRepository $EventRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param CategoryRepository    $categoryRepository    Category repository
     * @param EventRepository $EventRepository reposytory
     * @param PaginatorInterface    $paginator             Paginator
     */
    public function __construct(CategoryRepository $categoryRepository, EventRepository $EventRepository, PaginatorInterface $paginator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->EventRepository = $EventRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int         $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, ?string $name = null): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->categoryRepository->queryAll(),
            $page,
            CategoryRepository::PAGINATOR_ITEMS_PER_PAGE
        );

    }

    /**
     * Save entity.
     *
     * @param Category $category Category entity
     */
    public function save(Category $category): void
    {
        if (is_null($category->getId())) {
            $category->setCreatedAt(new DateTimeImmutable());
        }
        $category->setUpdatedAt(new DateTimeImmutable());

        $this->categoryRepository->save($category);
    }

    /**
     * Delete category.
     *
     * @param Category $category Category entity
     */
    public function delete(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }

    /**
     * Find by id.
     *
     * @param int $id Category id
     *
     * @return Category|null Category entity
     */
    public function findOneById(int $id): ?Category
    {
        return $this->categoryRepository->findOneById($id);
    }

    /**
     * Can Category be deleted?
     *
     * @param Category $category Category entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Category $category): bool
    {
        $result = $this->EventRepository->countByCategory($category);

        return !($result > 0);
    }
}
