package cafe.i4a.cafe.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.ordered;

//@Repository
public interface orderRepository extends JpaRepository<ordered, Long> {

    ordered findByName(String name);

    Optional<ordered> findById(Long id);

}
