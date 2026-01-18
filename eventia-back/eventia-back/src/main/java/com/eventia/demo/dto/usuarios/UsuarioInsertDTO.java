package com.eventia.demo.dto.usuarios;

import java.time.LocalDateTime;

import io.swagger.v3.oas.annotations.media.Schema;

public class UsuarioInsertDTO {

	public enum TipoUsuario {
		publico, artista, ayuntamiento
	}

	private String nombre;
	private String email;
	private String password;

	@Schema(description = "Tipo_usuario", example = "publico, artista, ayuntamiento", allowableValues = { "publico",
			"artista", "ayuntamiento" })
	private TipoUsuario tipo_usuario;

	@Schema(description = "Fecha y hora del evento", example = "2026-01-18T19:30")
	private LocalDateTime fechaRegistro;

	public UsuarioInsertDTO(String nombre, String email, String password, TipoUsuario tipo_usuario,
			LocalDateTime fecha_Registro) {
		super();
		this.nombre = nombre;
		this.email = email;
		this.password = password;
		this.tipo_usuario = tipo_usuario;
		this.fechaRegistro = fecha_Registro;
	}

	public UsuarioInsertDTO() {
		super();
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public TipoUsuario getTipo_usuario() {
		return tipo_usuario;
	}

	public void setTipo_usuario(TipoUsuario tipo_usuario) {
		this.tipo_usuario = tipo_usuario;
	}

	public LocalDateTime getFecha_Registro() {
		return fechaRegistro;
	}

	public void setFecha_Registro(LocalDateTime fecha_Registro) {
		this.fechaRegistro = fecha_Registro;
	}

}
