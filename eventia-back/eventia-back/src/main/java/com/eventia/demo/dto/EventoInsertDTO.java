package com.eventia.demo.dto;

import java.math.BigDecimal;
import java.sql.Date;

import com.fasterxml.jackson.annotation.JsonFormat;

public class EventoInsertDTO {

	private int id_ayuntamiento;
	private String nombre_evento;
	private String descripcion;
	private String categoria;
	private String localidad;
	private String provincia;
	private BigDecimal precio;
	@JsonFormat(pattern = "yyyy-MM-dd")
	private Date fecha_inicio;

	public EventoInsertDTO(int id_ayuntamiento, String nombre_evento, String descripcion, String categoria,
			String localidad, String provincia, BigDecimal precio, Date fecha_inicio) {
		super();
		this.id_ayuntamiento = id_ayuntamiento;
		this.nombre_evento = nombre_evento;
		this.descripcion = descripcion;
		this.categoria = categoria;
		this.localidad = localidad;
		this.provincia = provincia;
		this.precio = precio;
		this.fecha_inicio = fecha_inicio;
	}

	public EventoInsertDTO() {
		super();
	}

	public String getCategoria() {
		return categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}

	public String getLocalidad() {
		return localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getProvincia() {
		return provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public int getId_ayuntamiento() {
		return id_ayuntamiento;
	}

	public void setId_ayuntamiento(int id_ayuntamiento) {
		this.id_ayuntamiento = id_ayuntamiento;
	}

	public String getNombre_evento() {
		return nombre_evento;
	}

	public void setNombre_evento(String nombre_evento) {
		this.nombre_evento = nombre_evento;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public BigDecimal getPrecio() {
		return precio;
	}

	public void setPrecio(BigDecimal precio) {
		this.precio = precio;
	}

	public Date getFecha_inicio() {
		return fecha_inicio;
	}

	public void setFecha_inicio(Date fecha_inicio) {
		this.fecha_inicio = fecha_inicio;
	}

}
