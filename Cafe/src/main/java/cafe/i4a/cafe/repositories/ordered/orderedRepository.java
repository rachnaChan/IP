package cafe.i4a.cafe.repositories.ordered;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import cafe.i4a.cafe.models.ordered.ordered;


public interface orderedRepository extends JpaRepository<ordered, Long>{

    Optional<ordered> findById(Long id);
    
}
