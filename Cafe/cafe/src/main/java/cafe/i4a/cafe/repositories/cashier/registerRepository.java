package cafe.i4a.cafe.repositories.cashier;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
//import org.springframework.stereotype.Repository;
// import org.springframework.transaction.annotation.Transactional;

import cafe.i4a.cafe.models.cashier.register;

//@Repository
public interface registerRepository extends JpaRepository<register, Long> {

    register findByUsername(String username);

    Optional<register> findById(Long id);

}
