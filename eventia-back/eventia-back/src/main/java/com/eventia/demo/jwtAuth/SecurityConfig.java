package com.eventia.demo.jwtAuth;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.UsernamePasswordAuthenticationFilter;

//Esta anotacion le dice a spring que esta clase define Beans de configuracion
@Configuration
@EnableWebSecurity // Activa Spring Security y le dice a Spring que use esta configuracion, no la
					// default
public class SecurityConfig {

	// Se ainyecta el filtro JWT
	// Para validar el token y autenticar al usuario
	@Autowired
	private JwtAuthFilter jwtAuthFilter;

	@Autowired
	private UsuarioDetailsService usuarioDetailsService;

	/*
	 * Spring llama a este metodo al arrancar y crea la cadena de filtros de
	 * seguridad
	 * 
	 * CSRF protege formularios con sesion y cookies Debe desactivarse, porque si
	 * no, POST / PUT fallan
	 * 
	 * 
	 * Sesiones desactivadas Le dice a spring que no guarde usuarios en la sesion
	 * Asi cada request es independiente y se autentica solo con el JWT
	 * 
	 * 
	 * Reglas de acceso (requestMatchers()) Se especifican los endpoints publicos
	 * /auth/**", "/swagger-ui/**" y "/v3/api-docs/**" Eso es imprescindible para
	 * login, registro y swagger Todo lo demas requiere JWT valido
	 * 
	 * Añadir el filtro JWT Eso le dice a Spring que ejecute el filtro especificado
	 * antes del filtro de login normal
	 * 
	 * 
	 * .build() Cierra la configuracion y la registra
	 */
	@Bean
	public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {

		return http.csrf(csrf -> csrf.disable())
				.sessionManagement(sm -> sm.sessionCreationPolicy(SessionCreationPolicy.STATELESS))
				.authorizeHttpRequests(
						auth -> auth.requestMatchers("/auth/login", "/swagger-ui/**", "/v3/api-docs/**", "/usuarios/**")
								.permitAll().anyRequest().authenticated())
				.addFilterBefore(jwtAuthFilter, UsernamePasswordAuthenticationFilter.class).build();
	}

	@Bean
	public AuthenticationManager authManager(HttpSecurity http) throws Exception {
	    AuthenticationManagerBuilder authBuilder = http.getSharedObject(AuthenticationManagerBuilder.class);
	    authBuilder.userDetailsService(usuarioDetailsService).passwordEncoder(passwordEncoder());
	    return authBuilder.build();
	}

	@Bean
	public PasswordEncoder passwordEncoder() {
		return new BCryptPasswordEncoder();
	}

}
