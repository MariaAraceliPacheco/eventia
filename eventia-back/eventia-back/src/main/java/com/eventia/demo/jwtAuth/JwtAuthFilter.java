package com.eventia.demo.jwtAuth;

import java.io.IOException;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.stereotype.Component;
import org.springframework.web.filter.OncePerRequestFilter;

import jakarta.servlet.FilterChain;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

@Component
public class JwtAuthFilter extends OncePerRequestFilter {

	@Autowired
	private JwtService jwtService;

	@Autowired
	private UserDetailsService userDetailsService;

	@Override
	protected void doFilterInternal(HttpServletRequest request, HttpServletResponse response, FilterChain filterChain)
			throws ServletException, IOException {

		// lee la cabecera Authorization en busca de esto:
		// Authorization: Bearer eyJhbGciOiJIUzI1NiJ9...
		String authHeader = request.getHeader("Authorization");

		// Si no hay cabecera o no empieza por Bearer, no es una peticion autenticada
		// Deja pasar sin más
		// Esto sirve para login, registro y endpoints publicos
		if (authHeader == null || !authHeader.startsWith("Bearer ")) {
			filterChain.doFilter(request, response);
			return;
		}

		// Extraer el token sin Bearer (Bearer tiene 7 caracteres contando con el
		// espacio que se deja a la derecha)
		String token = authHeader.substring(7);

		// Valida la firma
		// Comprueba que no esté manipulado
		// Lee el claim sub
		// Si no es valido, salta una excepcion y se corta la request
		String username = jwtService.extraerUsername(token);

		// si username != null, el token tiene un sub valido
		// Eso evita sobreescribir autenticaciones y ejecutar esto varias veces en la
		// misma request
		if (username != null && SecurityContextHolder.getContext().getAuthentication() == null) {

			// Busca el usuario en la BD
			// Carga roles / authorities
			// no valida la contraseña (el JWT sustituye al password aqui)
			UserDetails user = userDetailsService.loadUserByUsername(username);

			// Aqui se comprueba si el usuario coincide y si el token no está caducado
			if (jwtService.esTokenValido(token, user)) {

				// Crea la autenticacion para spring
				// Es como si le dijera a spring "Este usuario está autenticado y tiene estos
				// roles"
				UsernamePasswordAuthenticationToken auth = new UsernamePasswordAuthenticationToken(user, null,
						user.getAuthorities());

				// Guarda la autenticacion
				SecurityContextHolder.getContext().setAuthentication(auth);
			}
		}

		// La request sigue hacia controller - servicio - repositorio, pero ya
		// autenticada
		filterChain.doFilter(request, response);

	}

}
