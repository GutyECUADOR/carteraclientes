USE [KAO_wssp]
GO
/****** Object:  Table [dbo].[carteracliente_nuevos]    Script Date: 02/01/2020 11:42:52 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[carteracliente_nuevos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [nchar](10) NOT NULL,
	[fecha] [date] NULL,
	[empresa] [nchar](3) NULL,
	[bodega] [nchar](3) NULL,
	[isfacturado] [bit] NULL,
	[isNuevoCliente] [bit] NULL,
	[asesor] [nchar](13) NULL,
	[clienteCI] [nchar](13) NOT NULL,
	[cliente] [nchar](50) NULL,
	[clienteFecha] [date] NULL,
	[clienteEmail] [nchar](50) NULL,
	[clienteEstadoCivil] [nchar](3) NULL,
	[clienteHijos] [nchar](3) NULL,
	[sexo] [nchar](1) NULL,
	[deporte] [nchar](3) NULL,
	[tipoinformacion] [nchar](100) NULL,
	[marca] [nchar](3) NULL,
	[comentarios] [nchar](200) NULL,
 CONSTRAINT [PK_carteracliente_nuevos] PRIMARY KEY CLUSTERED 
(
	[clienteCI] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[carteracliente_nuevos] ADD  CONSTRAINT [DF_carteracliente_nuevos_facturado]  DEFAULT ((0)) FOR [isfacturado]
GO
ALTER TABLE [dbo].[carteracliente_nuevos] ADD  CONSTRAINT [DF_carteracliente_nuevos_isNuevoCliente]  DEFAULT ((0)) FOR [isNuevoCliente]
GO
