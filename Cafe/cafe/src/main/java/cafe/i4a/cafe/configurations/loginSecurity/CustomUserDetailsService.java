package cafe.i4a.cafe.configurations.loginSecurity;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;

import cafe.i4a.cafe.models.cashier.register;
import cafe.i4a.cafe.repositories.cashier.registerRepository;
public class customUserDetailsService implements UserDetailsService {
  
  @Autowired private registerRepository userRepo;

  @Override
  public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
    register users = userRepo.findByUsername(username);
    if (users == null) {
      throw new UsernameNotFoundException("User Not Founded in our Cafe!!");
    }
    return new customUserDetails(users);
  }

}
