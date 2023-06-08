package cafe.i4a.cafe.configurations.loginSecurity;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.crypto.password.NoOpPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
@EnableWebSecurity
public class webSecurityConfig {

  @Bean
  public UserDetailsService userDetailsService() {
    return new customUserDetailsService();
  }

  @Bean
  public PasswordEncoder passwordEncoder() {
    return NoOpPasswordEncoder.getInstance();
  }

  // @Bean
  // public BCryptPasswordEncoder passwordEncoder(){
  // return new BCryptPasswordEncoder();
  // }

  @Bean
  public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
    http.authorizeHttpRequests(auth -> auth
        .requestMatchers("/login").permitAll()
        .requestMatchers("/admin/**").hasAnyAuthority("Admin")
        .requestMatchers("/cashier/**").hasAnyAuthority("Cashier")
        .anyRequest().authenticated());

    http.formLogin()
        .loginPage("/login")
        .usernameParameter("username")
        .successHandler(successHandler)
        .loginProcessingUrl("/login")
        .permitAll()
        .and()
        .logout().logoutUrl("/logout")
        .logoutSuccessUrl("/login")
        .permitAll();
    return http.build();

  }

  @Autowired
  private loginSuccessHandler successHandler;

}