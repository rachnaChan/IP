package cafe.i4a.cafe.repositories.ordered;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import cafe.i4a.cafe.models.orderDetailDrink.orderedDetailDrinks;


public interface orderDrinkRepository extends JpaRepository<orderedDetailDrinks, Long>{

    Optional<orderedDetailDrinks> findById(Long id);
    
}
