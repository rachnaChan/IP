package cafe.i4a.cafe.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.food;

//@Repository
public interface foodRepository extends JpaRepository<food, Long> {

    food findByName(String name);
    Optional<food> findById(Long id);
    
}
