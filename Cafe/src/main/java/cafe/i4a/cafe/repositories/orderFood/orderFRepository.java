package cafe.i4a.cafe.repositories.orderFood;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.orderFood.orderedF;

//@Repository
public interface orderFRepository extends JpaRepository<orderedF, Long> {

    orderedF findByName(String name);

    Optional<orderedF> findById(Long id);

}
