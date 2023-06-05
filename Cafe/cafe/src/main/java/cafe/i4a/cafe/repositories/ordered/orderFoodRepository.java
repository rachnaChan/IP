package cafe.i4a.cafe.repositories.ordered;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import cafe.i4a.cafe.models.orderDetailFood.orderedDetailFoods;


public interface orderFoodRepository extends JpaRepository<orderedDetailFoods, Long>{

    Optional<orderedDetailFoods> findById(Long id);
    
}
