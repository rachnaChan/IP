package cafe.i4a.cafe.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.drink;

//@Repository
public interface drinkRepository extends JpaRepository<drink, Long> {

    drink findByName(String name);

    Optional<drink> findById(Long id);

}
