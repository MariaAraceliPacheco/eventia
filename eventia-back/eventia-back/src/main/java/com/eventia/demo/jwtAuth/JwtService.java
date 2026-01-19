package com.eventia.demo.jwtAuth;

//IMPORTANTE IMPORTAR ESTA LIBRERIA Y NO OTRA
import java.security.Key;
import java.util.Date;

import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Service;

import io.jsonwebtoken.Claims;
import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.security.Keys;

@Service
public class JwtService {

	// Esto es la firma del token
	// Si alguien cambia el contenido del token, la firma deja de ser valida y
	// spring lo rechaza
	// Por eso es mejor nunca subirla a git, sino guardarla en el
	// application.properties
	// jwt.secret=clave_larga_y_segura

	private static final String SECRET_KEY = "clave_secreta_de_minimo_256bits";

	public String generarToken(UserDetails user) {
		return Jwts.builder().setSubject(user.getUsername()).setIssuedAt(new Date())
				.setExpiration(new Date(System.currentTimeMillis() + 1000 * 60 * 60))
				.signWith(getKey(), SignatureAlgorithm.HS256).compact();
	}

	public String extraerUsername(String token) {
		return extraerClaims(token).getSubject();
	}

	public boolean esTokenValido(String token, UserDetails user) {
		return extraerUsername(token).equals(user.getUsername()) && !tokenExpirado(token);
	}

	private boolean tokenExpirado(String token) {
		return extraerClaims(token).getExpiration().before(new Date());
	}

	//lee el contenido del token (payload), verifica la firma y devuelve los datos
	//Ese metodo se encarga de verificar la firma (clave secreta)
	//decodificar el payload
	//devolver los claims
	private Claims extraerClaims(String token) {
		return Jwts.parserBuilder().setSigningKey(getKey()).build().parseClaimsJws(token).getBody();
	}

	private Key getKey() {
		return Keys.hmacShaKeyFor(SECRET_KEY.getBytes());
	}

}
