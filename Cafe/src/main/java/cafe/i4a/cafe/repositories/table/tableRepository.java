package cafe.i4a.cafe.repositories.table;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;

import cafe.i4a.cafe.models.table.table;

//@Repository
public interface tableRepository extends JpaRepository<table, Long> {

    table findByNumber(Long number);

    Optional<table> findById(Long id);

}
