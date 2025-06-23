import { PrismaClient } from "../generated/prisma";

let prisma: PrismaClient

function createPrismaClient() {
  return new PrismaClient({
    log: process.env.NODE_ENV === 'development' ? ['query'] : []
  })
}

if (process.env.NODE_ENV === 'production') {
  prisma = createPrismaClient()
} else {
  if (!(global as any).prisma) {
    (global as any).prisma = createPrismaClient()
  }
  prisma = (global as any).prisma
}

export default prisma