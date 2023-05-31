package cafe.i4a.cafe.repositories.orderDrink;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.orderDrink.orderedD;

//@Repository
public interface orderDRepository extends JpaRepository<orderedD, Long> {

    orderedD findByName(String name);

    Optional<orderedD> findById(Long id);

}
